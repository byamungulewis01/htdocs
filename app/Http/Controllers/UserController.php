<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\marital;
use App\Models\Admission;
use App\Models\Compliance;
use App\Models\Phonenumber;
use Illuminate\Support\Str;
use App\Models\Lawscategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Roles;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\NotifyController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index()
    {
        $marital = marital::all();
        $allUsers = User::all()->count();
        $activeUsers = User::where('practicing', '<=', 2)->count();
        $inactiveUsers = User::where('practicing', 3)->count();
        $suspendedUsers = User::where('practicing', 4)->count();
        $struckoffUsers = User::where('practicing', 5)->count();
        $deseacedUsers = User::where('practicing', 6)->count();
        return view('users.individual', compact('marital', 'allUsers', 'activeUsers', 'inactiveUsers', 'suspendedUsers', 'struckoffUsers', 'deseacedUsers'));
    }
    public function export_users()
    {
        return view('users.export-data');
    }
    public function users_compliances(Request $request)
    {
        if (isset($request->year)) {
            $currentDate = $request->year;
            $year = substr($request->year, 0, 4);
        } else {
            $currentDate = date('Y-m-d');
            $year = Carbon::now()->year;
        }

        return view('users.compliance', compact('currentDate'));
    }
    public function users_compliances_api(Request $request)
    {
        if (isset($request->year)) {
            $currentDate = $request->year;
            $year = substr($request->year, 0, 4);
        } else {
            $currentDate = date('Y-m-d H:i:s');
            $year = Carbon::now()->year;
        }
        $data = DB::table('users')->join('phonenumbers', 'users.id', '=', 'phonenumbers.user_id')
            ->leftJoin('invitation', function ($join) use ($currentDate, $year) {
                $join->on('users.id', '=', 'invitation.user_id')
                    ->where('invitation.created_at', '<=', $currentDate)->where('invitation.yearInBar', '<=', $year);
            })
            ->leftJoin('bookings', function ($join) use ($currentDate, $year) {
                $join->on('users.id', '=', 'bookings.advocate')
                    ->where('bookings.created_at', '<=', $currentDate)->where('bookings.yearInBar', '<=', $year);
            })
            ->leftJoin('extra_cles', function ($join) use ($currentDate, $year) {
                $join->on('users.id', '=', 'extra_cles.advocate')
                    ->where('extra_cles.created_at', '<=', $currentDate)->where('extra_cles.yearInBar', '<=', $year);
            })->where('users.practicing', 2)
            ->select('users.name', 'users.date', 'users.regNumber', 'users.email', 'phonenumbers.phone',
                DB::raw('case users.status when 1 then "Advocate" when 2 then "Intern Advocate" when 3 then "Support Staff" when 4 then "Technic Staff" end AS status'),
                DB::raw('case users.practicing when 2 then "Active" else "Inactive" end as practicing'),
                DB::raw('(SELECT COALESCE(SUM(bookings.cumulatedCredit), 0) FROM bookings WHERE advocate = users.id) as bookings_credit'),
                DB::raw('(SELECT COALESCE(SUM(extra_cles.credits), 0) FROM extra_cles WHERE advocate = users.id) as extra_cles_credit'),
                DB::raw('(SELECT COALESCE(SUM(invitation.credit), 0) FROM invitation WHERE user_id = users.id) as invitation_credit'),
            )->groupBy('users.id')
            ->orderByRaw("CASE WHEN regNumber REGEXP '^[0-9]' THEN CAST(SUBSTRING_INDEX(regNumber, '/', 1) AS UNSIGNED) ELSE 999999999 END")
            ->orderBy("regNumber")
            ->get();


        if (!$request->expectsJson()) {
            return $data;
        } else {
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        }
    }
    public function users_compliances_notify(Request $request)
    {
        $formField = $request->validate([
            'recipients' => 'required',
            'from' => 'required',
            'date' => 'required',
            'to' => 'required',
            'message' => 'required',
            'sent' => 'required',
            'attachments.*' => 'max:10240', // Maximum file size of 10 MB
            'attachments' => 'max:5' // Maximum of 5 files
        ]);
        $year = substr($request->date, 0, 4);

        $user_id = Compliance::where('year', $year)->whereBetween('total_credits', [$request->from, $request->to])->pluck('user_id')->toArray();

        $attachments = $request->file('attachments');
        $attachmentsPaths = [];
        if ($attachments) {
            foreach ($attachments as $attachment) {
                $path = $attachment->store('attachments');
                $attachmentsPaths[] = $path;
            }
        }
        $recipient = [];
        foreach ($request->recipients as $value) {
            $recipient[] = $value;
        }

        $users = User::whereIn('status', $recipient)->whereIn('id', $user_id)->get();
        $sent = implode(',', $request->sent);
        if ($sent == 'EMAIL') {
            foreach ($users as $user) {
                // echo '<br> '.$user->name;
                (new NotifyController)->notify('', $user->email, $request->subject, $request->message, $attachmentsPaths);
            }
        } elseif ($sent == 'SMS') {
            foreach ($users as $user) {
                (new NotifyController)->notify_sms($request->message, $user->phone);
            }
        } else {
            foreach ($users as $user) {
                (new NotifyController)->notify('', $user->email, $request->subject, $request->message, $attachmentsPaths);
                (new NotifyController)->notify_sms($request->message, $user->phone);
            }
        }

        return back()->with('message', 'Notified Successfully');
    }
    public function usersCategory($status, $practicing)
    {
        $status_adv = $status;
        $practicing_adv = $practicing;
        $marital = marital::all();
        return view('users.category', compact('status_adv', 'practicing_adv', 'marital'));
    }
    public function categoryApi(Request $request)
    {

        $data = User::with(['phone'])->where('status', $request->status)->where('practicing', $request->practicing)
            ->orderByRaw("CASE WHEN regNumber REGEXP '^[0-9]' THEN CAST(SUBSTRING_INDEX(regNumber, '/', 1) AS UNSIGNED) ELSE 999999999 END")
            ->orderBy("regNumber")
            ->get();

        if (!$request->expectsJson()) {
            return $data;
        } else {
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        }
    }
    public function advocates()
    {
        $marital = marital::all();
        return view('users.advocate', compact('marital'));
    }
    public function advocatesApi(Request $request)
    {
        $data = User::with(['phone'])->where('status', 1)->get();
        if (!$request->expectsJson()) {
            return $data;
        } else {
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        }
    }
    public function interns()
    {
        $marital = marital::all();
        return view('users.intern', compact('marital'));
    }
    public function internsApi(Request $request)
    {
        $data = User::with(['phone'])->where('status', 2)
            ->orderByRaw("CASE WHEN regNumber REGEXP '^[0-9]' THEN CAST(SUBSTRING_INDEX(regNumber, '/', 1) AS UNSIGNED) ELSE 999999999 END")
            ->orderBy("regNumber")->get();
        if (!$request->expectsJson()) {
            return $data;
        } else {
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        }
    }

    public function api(Request $request)
    {

        // $data = User::with(['phone'])->orderBy("id")->get();
        $data = User::with(['phone'])->orderByRaw("CASE WHEN regNumber REGEXP '^[0-9]' THEN CAST(SUBSTRING_INDEX(regNumber, '/', 1) AS UNSIGNED) ELSE 999999999 END")
            ->orderBy("regNumber")
            ->get();
        if (!$request->expectsJson()) {
            return $data;
        } else {
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        }
    }
    public function deactivated()
    {
        return view('users.deactive');
    }
    public function deactiveApi(Request $request)
    {
        $data = User::onlyTrashed()->with(['phone'])->get();
        if (!$request->expectsJson()) {
            return $data;
        } else {
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        }
    }
    public function deseacedpage()
    {
        $marital = marital::all();
        $allUsers = User::all()->count();
        $activeUsers = User::where('practicing', '<=', 2)->count();
        $inactiveUsers = User::where('practicing', 3)->count();
        $suspendedUsers = User::where('practicing', 4)->count();
        $struckoffUsers = User::where('practicing', 5)->count();
        $deseacedUsers = User::where('practicing', 6)->count();
        return view('users.deseaced', compact('marital', 'allUsers', 'activeUsers', 'inactiveUsers', 'suspendedUsers', 'struckoffUsers', 'deseacedUsers'));
    }
    public function deseacedApi(Request $request)
    {
        $data = User::where('practicing', 6)->with(['phone'])->get();
        if (!$request->expectsJson()) {
            return $data;
        } else {
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        }
    }
    public function struckOffpage()
    {
        $marital = marital::all();
        $allUsers = User::all()->count();
        $activeUsers = User::where('practicing', '<=', 2)->count();
        $inactiveUsers = User::where('practicing', 3)->count();
        $suspendedUsers = User::where('practicing', 4)->count();
        $struckoffUsers = User::where('practicing', 5)->count();
        $deseacedUsers = User::where('practicing', 6)->count();
        return view('users.struckOff', compact('marital', 'allUsers', 'activeUsers', 'inactiveUsers', 'suspendedUsers', 'struckoffUsers', 'deseacedUsers'));
    }
    public function struckOffApi(Request $request)
    {
        $data = User::where('practicing', 5)->with(['phone'])->get();
        if (!$request->expectsJson()) {
            return $data;
        } else {
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        }
    }
    public function suspendedpage()
    {
        $marital = marital::all();
        $allUsers = User::all()->count();
        $activeUsers = User::where('practicing', '<=', 2)->count();
        $inactiveUsers = User::where('practicing', 3)->count();
        $suspendedUsers = User::where('practicing', 4)->count();
        $struckoffUsers = User::where('practicing', 5)->count();
        $deseacedUsers = User::where('practicing', 6)->count();
        return view('users.suspended', compact('marital', 'allUsers', 'activeUsers', 'inactiveUsers', 'suspendedUsers', 'struckoffUsers', 'deseacedUsers'));
    }
    public function suspendedApi(Request $request)
    {
        $data = User::where('practicing', 4)->with(['phone'])->get();
        if (!$request->expectsJson()) {
            return $data;
        } else {
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        }
    }
    public function inactivepage()
    {
        $marital = marital::all();
        $allUsers = User::all()->count();
        $activeUsers = User::where('practicing', '<=', 2)->count();
        $inactiveUsers = User::where('practicing', 3)->count();
        $suspendedUsers = User::where('practicing', 4)->count();
        $struckoffUsers = User::where('practicing', 5)->count();
        $deseacedUsers = User::where('practicing', 6)->count();
        return view('users.inactive', compact('marital', 'allUsers', 'activeUsers', 'inactiveUsers', 'suspendedUsers', 'struckoffUsers', 'deseacedUsers'));
    }
    public function inactiveApi(Request $request)
    {
        $data = User::where('practicing', 3)->with(['phone'])->get();
        if (!$request->expectsJson()) {
            return $data;
        } else {
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        }
    }
    public function activepage()
    {
        $marital = marital::all();
        $allUsers = User::all()->count();
        $activeUsers = User::where('practicing', '<=', 2)->count();
        $inactiveUsers = User::where('practicing', 3)->count();
        $suspendedUsers = User::where('practicing', 4)->count();
        $struckoffUsers = User::where('practicing', 5)->count();
        $deseacedUsers = User::where('practicing', 6)->count();
        return view('users.active', compact('marital', 'allUsers', 'activeUsers', 'inactiveUsers', 'suspendedUsers', 'struckoffUsers', 'deseacedUsers'));
    }
    public function active(Request $request)
    {
        $data = User::where('practicing', 2)->with(['phone'])->get();
        if (!$request->expectsJson()) {
            return $data;
        } else {
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        }
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users|unique:organizations',
            'phone' => 'required|min:10|max:10|unique:organizations',
            'district' => 'required',
            'gender' => 'required',
            'marital' => 'required',
            'date' => 'required',
            'category' => 'required',
            'status' => 'required',
            'practicing' => 'required',
        ]);

        if ($request->hasFile('profile')) {
            $file      = $request->file('profile');
            $filename  = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $profile   = date('His') . '-' . $filename;
            $file->move(public_path('assets/img/avatars'), $profile);
        } else {
            $profile = null;
        }

        if ($request->hasFile('diploma')) {
            $file      = $request->file('diploma');
            $filename  = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $diploma   = date('His') . '-' . $filename;
            $file->move(public_path('assets/img/diploma'), $diploma);
        } else {
            $diploma = null;
        }

        $email = $request->email;
        $password = Str::random(6);

        $count = User::count();
        $year = date("Y", strtotime($request->date));
        $year1 = date("y", strtotime($request->date));
        $idNumber = ($request->status == 1) ? ($count + 1) . '/T/' . $year : ($request->status == 2 ?  ($count + 1) . '/S/' . $year  : 'RSTA/' . ($count + 1) . '/' . $year1);
        $status = intval($request->status) < 3 ? 1 : 0;

        $category = $status ? 'Advocate' : 'Staff';

        $practicing = $request->practicing;

        $user = User::create(array_merge($request->only('name', 'email', 'district', 'gender', 'marital', 'status', 'date'), [
            'password' => Hash::make($password),
            'regNumber' => $idNumber,
            'category' => $category,
            'practicing' => $practicing,
            'photo' => $profile,
            'diplome' => $diploma
        ]));

        Phonenumber::create(['user_id' => $user->id, 'name' => 'mobile', 'phone' => $request->phone]);
        (new NotifyController)->newAccount($email, $password);

        return back()->with('message', 'New User added!');
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $request->express,
            'phone' => 'required|min:10|max:10',
            'district' => 'required',
            'gender' => 'required',
            'marital' => 'required',
            'status' => 'required',
            'category' => 'required',
            'date' => 'required',
            'practicing' => 'required',
            'express' => 'required'
        ]);

        $user = User::findorfail($request->express);

        // $count = User::where('email',$request->email)->where('id','<>',$user->id)->first();
        // if($count){
        //     throw ValidationException::withMessages([
        //         'email' => 'The email has already been taken.'
        //     ]);
        // }

        if ($request->hasFile('profile')) {
            $file      = $request->file('profile');
            $filename  = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $profile   = date('His') . '-' . $filename;
            $file->move(public_path('assets/img/avatars'), $profile);
        }

        if ($request->hasFile('diploma')) {
            $file      = $request->file('diploma');
            $filename  = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $diploma   = date('His') . '-' . $filename;
            $file->move(public_path('assets/img/diploma'), $diploma);
        }

        $email = $request->email;
        $password = Str::random(10);
        $date = strtotime($request->date);
        $regNumber = $user->regNumber;
        $reg = explode('/', $regNumber);
        if ($reg[0] == 'RSTA') {
            $num = $reg[1];
        } else {
            $num = $reg[0];
        }

        if ($request->status == 1) {
            $newId = $num . '/T/' . date("Y", strtotime($request->date));
        } elseif ($request->status == 2) {
            $newId = $num . '/S/' . date("Y", strtotime($request->date));
        } else {
            $newId = 'RSTA/' . $num . '/' . date("y", strtotime($request->date));
        }
        $status = intval($request->status) < 3 ? 1 : 0;

        $category = $status ? 'Advocate' : 'Staff';

        $practicing = $request->practicing;


        $user->name = $request->name;
        $user->district = $request->district;
        $user->gender = $request->gender;
        $user->marital = $request->marital;
        $user->status = $request->status;
        $user->category = $category;
        $user->date = $date;
        $user->practicing = $practicing;
        $user->photo = isset($profile) ? $profile : $user->photo;
        $user->regNumber = $newId;
        $user->diplome = isset($diploma) ? $diploma : $user->diplome;
        $user->email = $email;
        $user->save();

        $phone = Phonenumber::where('user_id', $user->id)->where('name', 'mobile');
        if ($phone) {
            $phone->delete();
        }

        Phonenumber::create(['user_id' => $user->id, 'name' => 'mobile', 'phone' => $request->phone]);
        // if($exEmail !== $request->email){
        //     (new NotifyController)->newEmail($email);
        //     (new NotifyController)->changedEmail();
        // }
        return back()->with('message', 'User updated!');
    }


    public function changeStatus(Request $request, User $user)
    {

        $this->validate($request, [
            'status' => 'required',
            'date' => 'required',
            'practicing' => 'required',
        ]);
        $user = User::findorfail($user->id);

        $date = strtotime($request->date);
        $regNumber = $user->regNumber;
        $reg = explode('/', $regNumber);
        if ($reg[0] == 'RSTA') {
            $num = $reg[1];
        } else {
            $num = $reg[0];
        }

        if ($request->status == 1) {
            $newId = $num . '/T/' . date("Y", strtotime($request->date));
        } elseif ($request->status == 2) {
            $newId = $num . '/S/' . date("Y", strtotime($request->date));
        } else {
            $newId = 'RSTA/' . $num . '/' . date("y", strtotime($request->date));
        }
        $status = intval($request->status) < 3 ? 1 : 0;

        $category = $status ? 'Advocate' : 'Staff';

        $practicing = $request->practicing;

        $user->status = $request->status;
        $user->category = $category;
        $user->date = $date;
        $user->practicing = $practicing;
        $user->blocked = $practicing == '5' ? true : $user->blocked;
        $user->regNumber = $newId;
        $user->save();
        return back()->with('message', 'User status updated!');
    }

    public function activate(Request $request)
    {
        $this->validate($request, [
            'express' => 'required',
        ]);
        $user = User::where('id', $request->express)->withTrashed()->first();
        $user->blocked = false;
        $user->deleted_at = NULL;
        $user->save();
        if (!$request->expectsJson()) {
            return back()->with('message', 'User activated successfully!');
        } else {
            return response()->json([
                'success' => true,
            ]);
        }
    }

    public function destroy(Request $request)
    {

        $user = User::findorfail($request->id);
        $user->blocked = true;
        $user->save();
        $user->delete();

        if (!$request->expectsJson()) {
            return back()->with('message', 'User deactivated successfully!');
        } else {
            return response()->json([
                'success' => true,
            ]);
        }
    }

    public function changePassword(Request $request, User $user)
    {

        $this->validate($request, [
            'newPassword' => 'required|min:6',
        ]);
        $user = User::findorfail($user->id);
        $user->password = Hash::make($request->newPassword);
        $user->updated_at = Carbon::now();
        $user->save();

        Admin::where('user_id', $user->id)->update([
            'password' => Hash::make($request->newPassword),
        ]);


        return back()->with('message', 'Password changed successfully!');
    }

    // download qrcode
    public function downloadQrCode($id)
    {
        $user = User::findorfail($id);
        $qrcode = QrCode::format('png')->size(500)->generate($user->regNumber);
        $name = $user->name . '.png';
        return response($qrcode)->header('Content-type', 'image/png')->header('Content-Disposition', 'attachment; filename="' . $name . '"');
    }
}
