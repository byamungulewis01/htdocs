<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Meeting;
use App\Models\Compliance;
use App\Models\Invitations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MeetingController extends Controller
{
    public function index()
    {

        $meetings = Meeting::orderby('created_at','desc')->get();
        return view('meetings.index', compact('meetings'));
    }
    public function show($meeting)
    {
         $attending = Invitations::where('meeting_id', $meeting)->count();
         $attended = Invitations::where('meeting_id', $meeting)->where('status',2)->count();
         $booked = Invitations::where('meeting_id', $meeting)->where('booked',1)->count();
        $invitations = DB::table('users')->join('invitation','users.id','=','invitation.user_id')
        ->where('invitation.meeting_id',$meeting)->where('invitation.status',2)->orderby('invitation.updated_at','desc')
        ->paginate(8);
        $meeting = Meeting::findorfail($meeting);
        $users = User::where('practicing',2)->get();
        return view('meetings.detail', compact('meeting','invitations','users','attending','attended','booked'));
    }
    public function inviteList($meeting)
    {
         $attending = Invitations::where('meeting_id', $meeting)->count();
         $attended = Invitations::where('meeting_id', $meeting)->where('status',2)->count();
         $booked = Invitations::where('meeting_id', $meeting)->where('booked',1)->count();
        $invitations = DB::table('users')->join('invitation','users.id','=','invitation.user_id')
        ->where('invitation.meeting_id',$meeting)->orderby('users.name')
        ->paginate(8);
        $meeting = Meeting::findorfail($meeting);
        $users = User::where('practicing',2)->get();
        return view('meetings.invite', compact('meeting','invitations','users','attending','attended','booked'));
    }
    public function export($meeting)
    {
        $meeting_id = $meeting;
        return view('meetings.attendance', compact('meeting_id'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        $users = User::Where('regNumber', 'LIKE', "%{$query}%")
        ->take(1)->get();
        return response()->json($users);
    }
 
    public function invite(Request $request)
    {
       foreach ($request->user as $key) {
        
        $check = Invitations::where('user_id', $key)->where('meeting_id', $request->meeting)->get();
        foreach ($check as $value) {
            $data = User::findorfail($value->user_id);
            $name = $data->name;
         return back()->with('warning',$name . ' Arleady invited choose others');
        }
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $yearInBar = ($currentMonth == 1) ? $currentYear - 1 : $currentYear;

      Invitations::create(['user_id' => $key, 'meeting_id' => $request->meeting, 'status' => 1 , 'yearInBar' => $yearInBar]);

       }
        $publish = Meeting::findorfail($request->meeting);
        $publish->published = 1;
        $publish->save();
        
       return back()->with('message','new Advocate invited');

    }
    public function api(Request $request)
    {
        $data = Meeting::orderby('date')->get();
        if (!$request->expectsJson()) {
            return $data;
        } else {
            return response()->json([
                'success' => true,
                'data' => $data,
            ]);
        }
    }
    public function meeting_expo(Request $request,$meeting)
    {
        $data = DB::table('users')
        ->join('invitation', 'users.id', '=', 'invitation.user_id')
        ->join('meetings', 'meetings.id', '=', 'invitation.meeting_id')
        ->where('meeting_id',$meeting)
        ->select('users.status AS admission', 'users.name', 'users.email', 'users.practicing', 'invitation.*', 'meetings.*')
        ->get();

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
        $datetime = $request->date;
        $date = date("Y-m-d", strtotime($datetime));
        $time = date("H:i:s", strtotime($datetime));

        $concern = implode(',', $request->concern);

        $this->validate($request,[
            'title' => 'required', 'date' => 'required', 'end' => 'required', 'deadline' => 'required',
            'venue' => 'required','credits' => 'required', 'concern' => 'required',
        ]);

        $concerns = [];
        foreach ($request->concern as $value) {
            $concerns[] = $value;
        }

        if ($request->published == 1) {
        $meeting = Meeting::create([
            'title' => $request->title,
            'date' => $date,
            'start' => $time,
            'end' => $request->end,
            'venue' => $request->venue,
            'credits' => $request->credits,
            'concern' =>  $concern,
            'published' => 1,
            'bookDeadline' => $request->deadline,
        ]);
        $users = User::whereIn('status',$concerns)->where('practicing',2)->get();

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $yearInBar = ($currentMonth == 1) ? $currentYear - 1 : $currentYear;

        foreach ($users as $user) {
            Invitations::create([
                    'user_id' => $user->id,
                    'meeting_id' => $meeting->id,
                    'status' => 1,
                    'yearInBar' => $yearInBar,
            ]);
        }
        }
        else {
            $meeting = Meeting::create([
            'title' => $request->title,
            'date' => $date,
            'start' => $time,
            'end' => $request->end,
            'venue' => $request->venue,
            'credits' => $request->credits,
            'concern' =>  $concern,
            'published' => 0,
            'bookDeadline' => $request->deadline,
        ]);
        }

        return redirect()->route('meetings.index')->with('message','New meeting registared');   

    }
    public function update(Request $request)
    {
        $datetime = $request->date;
        $date = date("Y-m-d", strtotime($datetime));
        $time = date("H:i:s", strtotime($datetime));

        // $concern = implode(',', $request->concern);
        // $concerns = [];
        // foreach ($request->concern as $value) {
        //     $concerns[] = $value;
        // }

        $meeting = Meeting::findorfail($request->meeting);
     
        if ($request->published == 1) {
            $meeting->title = $request->title;
            $meeting->date =  $date;
            $meeting->start = $time;
            $meeting->end = $request->end;
            $meeting->venue = $request->venue;
            $meeting->credits = $request->credits;
            $meeting->published = 1;
            $meeting->bookDeadline = $request->deadline;
            $meeting->save();
        }
        else {
            $meeting->title = $request->title;
            $meeting->date =  $date;
            $meeting->start = $time;
            $meeting->end = $request->end;
            $meeting->venue = $request->venue;
            $meeting->credits = $request->credits;
            $meeting->published = 0;
            $meeting->bookDeadline = $request->deadline;
            $meeting->save();
           
            Invitations::where('meeting_id', $request->meeting)->delete();
        }

        return redirect()->route('meetings.index')->with('message','New meeting registared');   

    }

    public function delete(Request $request)
    {
        $meeting = Meeting::findorfail($request->meeting);
        $meeting->delete();
        Invitations::where('meeting_id', $request->meeting)->delete();

        return back()->with('message', 'Meeting remove successfully');
    }

    public function removeInviter(Request $request)
    {
        $invitor = Invitations::findorfail($request->id);
        $invitor->delete();
        return back()->with('message', 'remove Successfully');
    }
    // 


    public function notify(Request $request)
    {
        $formField = $request->validate([
            'recipients' => 'required',
            'subject' => 'required',
            'message' => 'required|min:10',
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

         $ids = Invitations::where('status',$request->recipients)->where('meeting_id', $request->id)->pluck('user_id')->toArray();
         $users = User::whereIn('id', $ids)->get();


         $sent = implode(',', $request->sent);
            if ($sent == 'EMAIL') {
                foreach ($users as $user) {
                    $email = $user->email;
                    [$username, $domain] = explode('@', $email);
                    if (!checkdnsrr($domain, 'MX')) {
                        continue;
                    }
                   (new NotifyController)->notify_meeting($user->email,$request->subject,$request->message,$attachmentsPaths);
                  }
         
            }elseif ($sent == 'SMS') {
                foreach ($users as $user) {
                    (new NotifyController)->notify_sms($request->message,$user->phone);
                   }
            } else{
            foreach ($users as $user) {
                $email = $user->email;
                [$username, $domain] = explode('@', $email);
                if (!checkdnsrr($domain, 'MX')) {
                    continue;
                }
                (new NotifyController)->notify_meeting($user->email,$request->subject,$request->message,$attachmentsPaths);
                (new NotifyController)->notify_sms($request->message,$user->phone);
                }
            }

     return back()->with('message', 'Notified Successfully');
       
    }

    public function attends($meeting,$user)
    {
        $meet = Meeting::findorfail($meeting);
        $check = Invitations::where('meeting_id', $meeting)->where('user_id', $user)->count();;
        if ($check == 1) {
            Invitations::where('meeting_id', $meeting)->where('user_id', $user)
            ->take(1)->update([
            'credit' => $meet->credits,
            'status' => 2,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        #Creating User Complaince
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $yearInBar = ($currentMonth == 1) ? $currentYear - 1 : $currentYear;
        $meeting_credits = Invitations::where('user_id',$user)->where('yearInBar',$yearInBar)->sum('credit');

        $compliance = Compliance::where('user_id',$user)->where('year',$yearInBar)->count();
        if ($compliance == 0) {
           Compliance::create([
            'year' => $yearInBar,
            'user_id' => $user,
            'meeting_credits' => $meeting_credits,
            'total_credits' => $meeting_credits,
            'created_by' => auth()->guard('admin')->user()->id,
            'update_by' => auth()->guard('admin')->user()->id,
           ]);
        } else {

            $compliance = Compliance::where('user_id', $user)->where('year', $yearInBar)->first();
            $total = $compliance->total_credits + $meeting_credits;
            $compliance->update(['meeting_credits' => $meeting_credits,'total_credits' => $total]);
            
        }
         #Creating User Complaince
         
        return back()->with('message', 'Added to Attendence');
        } else {
        return back()->with('warning', 'User Not Invited on This meeting');
        }
        
      
    }
    public function updateStatus(Request $request)
    {
        // Retrieve the new status value from the request
        // $newStatus = $request->input('status');

        // Update the meeting table status in your database using the $newStatus value

        // Return a JSON response indicating the success or failure of the update
        return response()->json(['status' => 'success']);
    }

    // checkin
    public function checkin(Request $request)
    {
        $meeting = $request->meeting;
        $user = User::where('regNumber',$request->regNumber)->first()->id;
        $meet = Meeting::findorfail($meeting);
        $check = Invitations::where('meeting_id', $meeting)->where('user_id', $user)->count();;
        if ($check == 1) {
            Invitations::where('meeting_id', $meeting)->where('user_id', $user)
            ->take(1)->update([
            'credit' => $meet->credits,
            'status' => 2,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        #Creating User Complaince
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $yearInBar = ($currentMonth == 1) ? $currentYear - 1 : $currentYear;
        $meeting_credits = Invitations::where('user_id',$user)->where('yearInBar',$yearInBar)->sum('credit');

        $compliance = Compliance::where('user_id',$user)->where('year',$yearInBar)->count();
        if ($compliance == 0) {
           Compliance::create([
            'year' => $yearInBar,
            'user_id' => $user,
            'meeting_credits' => $meeting_credits,
            'total_credits' => $meeting_credits,
            'created_by' => auth()->guard('admin')->user()->id,
            'update_by' => auth()->guard('admin')->user()->id,
           ]);
        } else {

            $compliance = Compliance::where('user_id', $user)->where('year', $yearInBar)->first();
            $total = $compliance->total_credits + $meeting_credits;
            $compliance->update(['meeting_credits' => $meeting_credits,'total_credits' => $total]);
            
        }
         #Creating User Complaince
         
        return back()->with('message', 'Added to Attendence');
        } else {
        return back()->with('warning', 'User Not Invited on This meeting');
        }
    }

}
