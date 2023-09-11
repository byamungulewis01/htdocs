<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Booking;
use App\Models\ExtraCle;
// use Barryvdh\DomPDF\PDF;
use App\Models\Training;
use App\Models\Compliance;
use Illuminate\Http\Request;
use App\Models\TrainingTopic;
use App\Exports\TrainingExport;
use App\Models\TrainingMaterial;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class TrainingController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $trainings = Training::where('title', 'like', '%' . $request->search . '%')->paginate(10);
        } else {
            $trainings = Training::orderBy('created_at', 'desc')->paginate(10);
        }
        return view('training.index', compact('trainings'));
    }
    public function export()
    {
        return view('training.export-data');
    }
    public function api(Request $request)
    {
        $data = Training::all();
        if (!$request->expectsJson()) {
            return $data;
        } else {
            return response()->json([
                'success' => true,
                'data' => $data,
            ]);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'category' => 'required',
            'venue' => 'required',
            'credits' => 'required|numeric',
            'price' => 'required|numeric',
            'starton' => 'required',
            'endon' => 'required',
            'early_deadline' => 'required',
            'late_deadline' => 'required',
            'rate' => 'required',
            'seats' => 'required|numeric',
        ]);

        $publish = $request->publish == 1 ? 2 : 1;
        Training::create([
            'title' => $request->title,
            'category' => $request->category,
            'venue' => $request->venue,
            'credits' => $request->credits,
            'price' => $request->price,
            'starton' => $request->starton,
            'endon' => $request->endon,
            'early_deadline' => $request->early_deadline,
            'late_deadline' => $request->late_deadline,
            'rate' => $request->rate,
            'seats' => $request->seats,
            'publish' => $publish,
            'register' => auth()->guard('admin')->user()->id,
        ]);

        return back()->with('message', 'Training registered!');
    }
    public function delete(Request $request)
    {
        TrainingMaterial::where('training_id', $request->id)->delete();
        TrainingTopic::where('training_id', $request->id)->delete();
        Booking::where('training', $request->id)->delete();
        Training::findorfail($request->id)->delete();
        return back()->with('message', 'Training removed');
    }
    public function details($details)
    {
        $users = User::where('practicing', 2)->orderby('name')->get();
        $training = Training::findorfail($details);
        $topics = TrainingTopic::where('training_id', $details)->get();
        $materials = TrainingMaterial::where('training_id', $details)->get();
        return view('training.details', compact('training', 'topics', 'materials', 'users'));
    }
    public function booked($details)
    {
        $users = User::where('practicing', 2)->orderby('name')->get();
        $training = Training::findorfail($details);
        $bookings = Booking::where('training', $details)->where('booked', true)->get();

        return view('training.booked', compact('training', 'bookings', 'users'));
    }
    public function confirmed($details)
    {
        $users = User::where('practicing', 2)->orderby('name')->get();
        $training = Training::findorfail($details);
        $bookings = Booking::where('training', $details)->where('confirm', true)->get();
        return view('training.confirmed', compact('training', 'bookings', 'users'));
    }
    public function manage($details)
    {
        $users = User::where('practicing', 2)->orderby('name')->get();
        $training = Training::findorfail($details);
        $bookings = Booking::where('training', $details)->paginate(10);
        $bookings_count = $bookings->count();
        return view('training.manage', compact('training', 'bookings', 'users', 'bookings_count'));
    }
    public function EditBulk(Request $request)
    {
        $formDate = $request->validate([
            'user' => 'required',
            'price' => 'required',
            'credits' => 'required',
            'status' => 'required',
        ]);
        if ($request->status == 4) {
         $formDate['cumulatedCredit'] = $request->credits;
         Booking::findorfail($request->id)->update($formDate);
            #Creating User Complaince
            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;
            $yearInBar = ($currentMonth == 1) ? $currentYear - 1 : $currentYear;
            $cle_credits = Booking::where('advocate',$request->user)->sum('cumulatedCredit');

            $compliance = Compliance::where('user_id', $request->user)->where('year', $yearInBar)->count();
            if ($compliance == 0) {
                Compliance::create([
                    'year' => $yearInBar,
                    'user_id' => $request->user,
                    'cle_credits' => $cle_credits,
                    'total_credits' => $cle_credits,
                    'created_by' => auth()->guard('admin')->user()->id,
                    'update_by' => auth()->guard('admin')->user()->id,
                ]);
            } else {
            $compliance = Compliance::where('user_id',$request->user)->where('year', $yearInBar)->first();
            $total = $compliance->total_credits + $cle_credits;
                $compliance->update(['cle_credits' => $cle_credits,'total_credits' => $total]);
            }
            #Creating User Complaince
        } else {
            $formDate['cumulatedCredit'] = NULL;
            Booking::findorfail($request->id)->update($formDate);
        }
        
       
        return back()->with('message', 'Edited Bulk');
    }
    public function DeleteBulk(Request $request)
    {
        
        Booking::findorfail($request->id)->delete();
        return back()->with('message', 'Deleted Bulk');

    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'category' => 'required',
            'venue' => 'required',
            'credits' => 'required|numeric',
            'price' => 'required|numeric',
            'starton' => 'required',
            'endon' => 'required',
            'early_deadline' => 'required',
            'late_deadline' => 'required',
            'rate' => 'required',
            'seats' => 'required|numeric',
        ]);

        $publish = $request->publish == 1 ? 2 : 1;
        $training = Training::find($request->id);
        $training->title = $request->title;
        $training->category = $request->category;
        $training->venue = $request->venue;
        $training->credits = $request->credits;
        $training->price = $request->price;
        $training->starton = $request->starton;
        $training->endon = $request->endon;
        $training->early_deadline = $request->early_deadline;
        $training->late_deadline = $request->late_deadline;
        $training->rate = $request->rate;
        $training->seats = $request->seats;
        $training->publish = $publish;
        $training->register = auth()->guard('admin')->user()->id;
        $training->save();

        return back()->with('message', 'Training Updated!');
    }
    public function addTopic(Request $request)
    {
        $formDate = $request->validate([
            'topic' => 'required',
            'startAt' => 'required',
            'endAt' => 'required',
            'trainer' => 'required',
        ]);
        $formDate['training_id'] = $request->id;
        $formDate['register'] = auth()->guard('admin')->user()->id;
        TrainingTopic::create($formDate);
        return back()->with('message', 'Training Topic Added');
    }
    public function topicDelete(Request $request)
    {

        $topic = TrainingTopic::find($request->topic_id);
        $topic->delete();
        return back()->with('warning', 'Training Topic Deleted');
    }
    public function addMaterial(Request $request)
    {
        $formDate = $request->validate([
            'title' => 'required',
            'file_name' => 'required|mimes:doc,docx,ppt,pptx,pdf',
        ]);

        if ($request->hasFile('file_name')) {
            $file = $request->file('file_name');
            $filename = $file->getClientOriginalName();
            $material = date('His') . '-' . $filename;
            $file->move(public_path('assets/img/materials'), $material);
        }
        $formDate['training_id'] = $request->id;
        $formDate['file'] = $material;
        $formDate['register'] = auth()->guard('admin')->user()->id;
        TrainingMaterial::create($formDate);
        return back()->with('message', 'Training Material Added');
    }
    public function download($file)
    {
        $pathToFile = public_path('assets/img/materials/' . $file);
        return response()->download($pathToFile);
    }
    public function materialDelete(Request $request)
    {

        $material = TrainingMaterial::find($request->id);
        $pathToFile = public_path('assets/img/materials/');
        $filename = $material->file;
        unlink($pathToFile . $filename);
        $material->delete();
        return back()->with('warning', 'Training Material Deleted');
    }

    public function addParticipant(Request $request)
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $yearInBar = ($currentMonth == 1) ? $currentYear - 1 : $currentYear;
        
        $toDayDate = Carbon::now()->format('Y-m-d');
        if ($request->endon < $toDayDate) {
           $credit = $request->credit;
        } else {
            $credit = NULL;
        }
        
        foreach ($request->user as $user) {
            $check = Booking::where('advocate', $user)->where('training', $request->id)->get();
            foreach ($check as $value) {
                $data = User::findorfail($value->advocate);
                $name = $data->name;
                return back()->with('warning', $name . ' Arleady Existy');
            }
            Booking::create(['training' => $request->id, 'advocate' => $user, 'yearInBar' => $yearInBar, 'status' => 4, 'cumulatedCredit' => $credit]);
        }
        return to_route('trainings.manage', $request->id)->with('message', 'Participant Added');
    }
    public function generateVouchers(Request $request)
    {
        $users = Booking::where('training', $request->id)->get();
        foreach ($users as $user) {
            Booking::where('advocate', $user->advocate)->where('training', $request->id)
                ->update(['attendanceDay' => $request->attendanceDay,
                    'cumulatedCredit' => $request->credits,
                    'voucherNumber' => rand(1000000, 9999999),
                ]);
          
              #Creating User Complaince
            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;
            $yearInBar = ($currentMonth == 1) ? $currentYear - 1 : $currentYear;
            $cle_credits = Booking::where('advocate',$user->advocate)->sum('cumulatedCredit');

            $compliance = Compliance::where('user_id', $user->advocate)->where('year', $yearInBar)->count();
            if ($compliance == 0) {
                Compliance::create([
                    'year' => $yearInBar,
                    'user_id' => $user->advocate,
                    'cle_credits' => $cle_credits,
                    'total_credits' => $cle_credits,
                    'created_by' => auth()->guard('admin')->user()->id,
                    'update_by' => auth()->guard('admin')->user()->id,
                ]);
            } else {
            $compliance = Compliance::where('user_id', $user->advocate)->where('year', $yearInBar)->first();
            $total = $compliance->total_credits + $cle_credits;
                $compliance->update(['cle_credits' => $cle_credits,'total_credits' => $total]);
            }
            #Creating User Complaince
        }

        return back()->with('message', 'Attendence Voucher numbers created');

    }

    public function voucher($id)
    {
        $vouchers = Booking::where('training', $id)->get();
        $pdf = PDF::loadView('training.vourchers', ['vouchers' => $vouchers],
        ['orientation' => 'portrait']);
        return $pdf->download('vouchers.pdf');
    }

    public function notify(Request $request)
    {
        $formField = $request->validate([
            'recipients' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'sent' => 'required',
        ]);
        $recipient = [];
        foreach ($request->recipients as $value) {
            $recipient[] = $value;
        }

        $ids = Booking::whereIn('status', $recipient)->where('training', $request->id)->pluck('advocate')->toArray();
        $users = User::whereIn('id', $ids)->get();
        $sent = implode(',', $request->sent);
        if ($sent == 'EMAIL') {
            foreach ($users as $user) {
                $email = $user->email;
                [$username, $domain] = explode('@', $email);
                if (!checkdnsrr($domain, 'MX')) {
                    continue;
                }
                (new NotifyController)->notify_training($user->email, $request->subject, $request->message);
            }
        } elseif ($sent == 'SMS') {
           
            foreach ($users as $user) {
                (new NotifyController)->notify_sms($request->message, $user->phone);
            }
        } else {
            foreach ($users as $user) {
                $email = $user->email;
                [$username, $domain] = explode('@', $email);
                if (!checkdnsrr($domain, 'MX')) {
                    continue;
                }
                (new NotifyController)->notify_training($user->email, $request->subject, $request->message);
                (new NotifyController)->notify_sms($request->message, $user->phone);
            }
        }

        return back()->with('message', 'Notified Successfully');

    }
    public function paytraining(Request $request)
    {
        $booking = Booking::findorfail($request->id);
        $booking->confirm = true;
        $booking->status = 2;
        $train = $booking->training;
        $booking->save();

        $training = Training::findorfail($train);
        $confirm = $training->confirm;
        $training->confirm = $confirm + 1;
        $training->save();

        return back()->with('message', 'Training Payeed Successfully');
    }
    public function add_extraCle(Request $request)
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $yearInBar = ($currentMonth == 1) ? $currentYear - 1 : $currentYear;

        $formField = $request->validate([
            'title' => 'required',
            'closing_date' => 'required',
            'category' => 'required',
            'hours' => 'required',
        ]);

        $formField['advocate'] = $request->user;
        $formField['credits'] = $request->hours * 0.067;
        $formField['yearInBar'] = $yearInBar;

        ExtraCle::create($formField);

          #Creating User Complaince
    
          $extra_credits = ExtraCle::where('advocate',$request->user)->where('yearInBar',$yearInBar)->sum('credits');

          $compliance = Compliance::where('user_id', $request->user)->where('year', $yearInBar)->count();
          if ($compliance == 0) {
              Compliance::create([
                  'year' => $yearInBar,
                  'user_id' => $request->user,
                  'extra_credits' => $extra_credits,
                  'total_credits' => $extra_credits,
                  'created_by' => auth()->guard('admin')->user()->id,
                  'update_by' => auth()->guard('admin')->user()->id,
              ]);
          } else {
             $compliance = Compliance::where('user_id', $request->user)->where('year', $yearInBar)->first();
                 $total = $compliance->total_credits + $extra_credits;
                  $compliance->update(['extra_credits' => $extra_credits,'total_credits' => $total]);
          }
          #Creating User Complaince


        return back()->with('message', 'Extra CLE Add Successfully');
    }
    public function remove_extraCle(Request $request)
    {
        ExtraCle::findorfail($request->id)->delete();
        $comp = Compliance::where('user_id',$request->user)->where('year',$request->yearInBar)->first();
        $credits = $comp->extra_credits - $request->credits;
        $comp->update(['extra_credits' => $credits]);
        return back()->with('message', 'Extra CLE Removed Successfully');
    }

    // export
    public function excelExport($id)
    {
        $traing = Training::findorfail($id);
        $bookings = Booking::where('training', $id)->get();
        $data = [];
        foreach ($bookings as $key => $booking) {
            $data[] = [
                'id' => $key + 1,
                'name' => $booking->user->name,
                'email' => $booking->user->email,
                'phone' => $booking->user->phone[0]->phone,
                'status' => ($booking->status == 1) ? 'Booking' : (($booking->status == 2) ? 'Confirm' : (($booking->status == 3) ? 'Attending' : 'Attended')),
                'credit' => $booking->cumulatedCredit,
                'price' => $booking->trains->price,
            ];
        }
        return Excel::download(new TrainingExport($data), $traing->title.'.xlsx');
    }

}
