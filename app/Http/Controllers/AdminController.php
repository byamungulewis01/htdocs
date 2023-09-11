<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Booking;
use App\Models\Meeting;
use App\Models\Probono;
use App\Models\ExtraCle;
use App\Models\MailSend;
use App\Models\Training;
use App\Models\Compliance;
use App\Models\Discipline;
use App\Models\UserNotify;
use Illuminate\Support\Str;
use App\Models\Contribution;
use Illuminate\Http\Request;
use App\Models\DisciplineSitting;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\DisciplineParticipant;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function profile(User $user)
    {
        $user_id = $user->id;
        $role = Admin::where('user_id',$user->id)->first();
        $User = User::findorfail($user->id)->with('phone', 'address', 'areas');

        $logs = User::find($user->id)->authentications;
        $laws = $user->areas->pluck('lawscategory_id')->toArray();
        $roles = Role::orderBy('name')->get();
        $userlaws = $user->areas->pluck('lawscategory_id')->toArray();
        $facebook = '';
        $instagram = '';
        $twitter = '';
        $whatsapp = '';
        foreach ($user->socials as $social) {
            $facebook = $social->social == 'facebook' ? $social->link : $facebook;
            $instagram = $social->social == 'instagram' ? $social->link : $instagram;
            $twitter = $social->social == 'twitter' ? $social->link : $twitter;
            $whatsapp = $social->social == 'whatsapp' ? $social->link : $whatsapp;
        }

        $facebook = empty($facebook) ? ['icon' => 'ti-link', 'link' => '', 'btn' => 'secondary', 'label' => 'link'] : ['icon' => 'ti-trash', 'link' => $facebook, 'btn' => 'danger', 'label' => 'unlink'];
        $instagram = empty($instagram) ? ['icon' => 'ti-link', 'link' => '', 'btn' => 'secondary', 'label' => 'link'] : ['icon' => 'ti-trash', 'link' => $instagram, 'btn' => 'danger', 'label' => 'unlink'];
        $twitter = empty($twitter) ? ['icon' => 'ti-link', 'link' => '', 'btn' => 'secondary', 'label' => 'link'] : ['icon' => 'ti-trash', 'link' => $twitter, 'btn' => 'danger', 'label' => 'unlink'];
        $whatsapp = empty($whatsapp) ? ['icon' => 'ti-link', 'link' => '', 'btn' => 'secondary', 'label' => 'link'] : ['icon' => 'ti-trash', 'link' => $whatsapp, 'btn' => 'danger', 'label' => 'unlink'];

        return view('profile.profile', compact('user_id', 'user', 'logs', 'role','roles', 'userlaws', 'facebook', 'instagram', 'twitter', 'whatsapp'));
    }
    public function discipline($user)
    {
        $cases = Discipline::where('p_advocate', $user)->orWhere('d_advocate', $user)->get();
        $user = User::findorfail($user);
        $user_id = $user->id;

        return view('profile.discipline', compact('cases', 'user_id'));
    }

    public function discipline_delails($user, $case)
    {
        $sittings = DisciplineSitting::where('discipline_case', $case)->get();
        $members = DisciplineParticipant::where('discipline_case', $case)->get();

        $case = Discipline::findorfail($case);
        $user_id = $user;
        return view('profile.discipline_delails', compact('case', 'user_id', 'members', 'sittings'));
    }
    public function meeting($user)
    {
        $meetings = Meeting::join('invitation', 'meetings.id', '=', 'invitation.meeting_id')
            ->where('invitation.user_id', $user)
            ->select('meetings.*', 'invitation.*')
            ->orderby('date')->get();
        $user = User::findorfail($user);
        $user_id = $user->id;
        return view('profile.meeting', compact('meetings', 'user_id'));
    }
    public function probono($user)
    {
        $probonos = Probono::join('probono_participants', 'probonos.id', '=', 'probono_participants.probono_id')
            ->where('probono_participants.user_id', $user)
            ->select('probonos.*','probonos.id AS probono_id', 'probono_participants.*')
            ->orderby('probonos.created_at', 'desc')->get();
        $user = User::findorfail($user);
        $user_id = $user->id;
        return view('profile.probono', compact('probonos', 'user_id'));
    }
    public function training($user)
    {
        $user = User::findorfail($user);
        $user_id = $user->id;
        $name = $user->name;

        $bookings = Booking::where('advocate' , $user_id)->orderBy('created_at','desc')->paginate(10);
        $booked = Booking::where('advocate',$user_id)->pluck('training')->toArray();
        $attendances = Booking::where('advocate' , $user_id)->where('attendanceDay', '<>', null)->where('status',4)->orderBy('created_at','desc')->take(5)->get();
        $extraCles = ExtraCle::where('advocate',$user_id)->orderBy('created_at','desc')->take(5)->get();
        return view('profile.training.training', compact('name','user_id','bookings','booked','attendances','extraCles'));
    }
    public function training_archive($user)
    {
        $user = User::findorfail($user);
        $user_id = $user->id;
        $name = $user->name;

        $booked = Booking::where('advocate',$user_id)->pluck('training')->toArray();
        $attendances = Booking::where('advocate' , $user_id)->where('attendanceDay', '<>', null)->where('status',4)->orderBy('created_at','desc')->take(5)->get();
        $extraCles = ExtraCle::where('advocate',$user_id)->orderBy('created_at','desc')->take(5)->get();
        return view('profile.training.archives', compact('name','user_id','booked','attendances','extraCles'));
    }
    public function training_extra($user)
    {
        $user = User::findorfail($user);
        $user_id = $user->id;
        $name = $user->name;

        $booked = Booking::where('advocate',$user_id)->pluck('training')->toArray();
        $attendances = Booking::where('advocate' , $user_id)->where('attendanceDay', '<>', null)->where('status',4)->orderBy('created_at','desc')->take(5)->get();
        $extraCles = ExtraCle::where('advocate',$user_id)->orderBy('created_at','desc')->take(5)->get();
        return view('profile.training.extraCle', compact('name','user_id','booked','attendances','extraCles'));
    }
    // archiveApi
    public function archiveApi(Request $request,$user)
    {
        $data = Booking::where('advocate' , $user)->where('status',4)->
        join('trainings','bookings.training','=','trainings.id')
        ->select('bookings.*','trainings.*')->get();
        if (!$request->expectsJson()) {
            return $data;
        } else {
            return response()->json([
                'success' => true,
                'data' => $data,
            ]);
        }
    }
    public function extraApi(Request $request,$user)
    {
        $data = ExtraCle::where('advocate',$user)->orderBy('created_at','desc')->get();
        if (!$request->expectsJson()) {
            return $data;
        } else {
            return response()->json([
                'success' => true,
                'data' => $data,
            ]);
        }
    }
    public function compliance(Request $request,$user)
    {
        
        if (isset($request->year)) {
            $year = substr($request->year, 0, 4);
         } else {
             $year = Carbon::now()->year;
         }

        $user = User::findorfail($user);
        $user_id = $user->id;
        $contribution = Contribution::where('yearInBar', $year)->first();
        $complaince = Compliance::where('user_id', $user_id)->where('year',$year)->first();
        return view('profile.compliance', compact('user', 'user_id', 'contribution','complaince'));
    }

    public function notify()
    {
        $users = User::where('practicing', '<>', 6)->get();
        $Actives = User::where('practicing', 2)->orderBy('name')->get();
        $status = MailSend::orderBy('id','desc')->first()->status;
        $mailSents = MailSend::where('status',$status)->get();
        return view('notify', compact('users', 'Actives','mailSents'));
    }
    public function send_notify(Request $request)
    {
        $formField = $request->validate([
            'recipient' => 'required',
            'category' => 'required',
            'message' => 'required',
            'sent' => 'required',
            'attachments.*' => 'max:10240', // Maximum file size of 10 MB
            'attachments' => 'max:5' // Maximum of 5 files
        ]);

        $attachments = $request->file('attachments');
        $attachmentsPaths = [];
        if ($attachments) {
            foreach ($attachments as $attachment) {
                $path = $attachment->store('attachments');
                $attachmentsPaths[] = $path;
            }
        }
        $recipient = [];
        foreach ($request->recipient as $value) {
            $recipient[] = $value;
        }

        $category = [];
        foreach ($request->category as $value) {
            $category[] = $value;
        }
        $users = User::whereIn('status', $category)->whereIn('practicing', $recipient)->get();
   
        $sent = implode(',', $request->sent);
            if ($sent == 'EMAIL') {
                foreach ($users as $user) {           
                 (new NotifyController)->notify($user->name, $user->email,$request->subject,$request->message,$attachmentsPaths);
                }
            } 
            elseif ($sent == 'SMS') {
                
                foreach ($users as $user) {

                    (new NotifyController)->notify_sms($request->message, $user->phone);
                }
            } else {
              
                foreach ($users as $user) {
         
                (new NotifyController)->notify($user->name ,$user->email,$request->subject,$request->message,$attachmentsPaths);
                (new NotifyController)->notify_sms($request->message, $user->phone);
                }
            }
        
        return back()->with('message', 'Notified Successfully');
    }
    // public function quicky_notify(Request $request)
    // {
    //     $recipient = [];
    //     foreach ($request->user as $value) {
    //         $recipient[] = $value;
    //     }
    //     $users = User::whereIn('id', $recipient)->get();

    //     foreach ($users as $user) {
    //         $email = $user->email;
    //         [$username, $domain] = explode('@', $email);
    //         if (!checkdnsrr($domain, 'MX')) {
    //             continue;
    //         }
    //         $password = Str::random(8);
    //         $user->password = Hash::make($password);
    //         $user->save();
          
    //         (new NotifyController)->quicky_notify($user->email,$user->name,$password);
    //     }
    //     return back()->with('message', 'Notified Successfully');
    // }

}
