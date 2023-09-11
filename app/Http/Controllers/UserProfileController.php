<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Booking;
use App\Models\Meeting;
use App\Models\Probono;
use App\Models\Training;
use App\Models\Compliance;
use App\Models\Discipline;
use App\Models\Probono_dev;
use App\Models\ProbonoFile;
use App\Models\Contribution;
use App\Models\Lawscategory;
use Illuminate\Http\Request;
use App\Models\TrainingTopic;
use App\Models\Probonocategory;
use App\Models\DisciplineReport;
use App\Models\TrainingMaterial;
use App\Models\DisciplineSitting;
use Illuminate\Support\Facades\Hash;
use App\Models\DisciplineParticipant;
use App\Models\Invitations;
use PHPUnit\Framework\MockObject\Invocation;

class UserProfileController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');

      
    }

    public function myprofile()
    {
        $user = auth()->user();

        $role = Admin::where('email',auth()->user()->email)->where('name',auth()->user()->name)->first();
        $laws = Lawscategory::all();
        $userlaws = $user->areas->pluck('lawscategory_id')->toArray();
        $logs = User::find($user->id)->authentications;

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

        return view('myprofile.myprofile', compact('user', 'role','logs', 'laws', 'userlaws', 'facebook', 'instagram', 'twitter', 'whatsapp'));
    }
    public function mydiscipline()
    {
        $user = auth()->user();
        $user_id = $user->id;

        $part = DisciplineParticipant::where('advocate', $user_id)->get();

        $ids = DisciplineParticipant::where('advocate', $user_id)->pluck('discipline_case')->toArray();

        $cases = Discipline::whereIn('id', $ids)->get();

        return view('myprofile.discipline', compact('user', 'cases'));
    }

    public function discipline_delails($case)
    {
        
        $sittings = DisciplineSitting::where('discipline_case', $case)->get();
        $members = DisciplineParticipant::where('discipline_case', $case)->get();

        $case = Discipline::findorfail($case);
        return view('myprofile.discipline_delails', compact('case', 'members', 'sittings'));
    }
    public function discipline_report(Request $request)
    {
        $formField = $request->validate([
            'comments' => 'required',
            'attachements.*' => 'max:10240', // Maximum file size of 10 MB
            'attachements' => 'max:5' // Maximum of 5 files
        ]);
        $attachmentsPaths = [];
        if ($request->hasFile('attachements')) {
            foreach($request->file('attachements') as $file){
                $name = $file->getClientOriginalName();
                $attach_file   = date('His').'-'.$name;
                $file->move(public_path().'/assets/img/files/', $attach_file);
                $attachmentsPaths[] = $attach_file;
            }
        }
       $attachs = implode(',', $attachmentsPaths);
       DisciplineReport::create([
           'discipline_id' => $request->discipline_id,
           'user_id' => auth()->user()->id,
           'sitting_id' => $request->sitting_id,
           'comments' => $request->comments,
           'attachements' => $attachs,]);

        return back()->with('message', 'Report Submitted Successfully');
    }


    public function mymeeting()
    {
        $user = auth()->user()->id;
        $meetings = Invitations::where('user_id', $user)->orderby('created_at', 'desc')->get();

        return view('myprofile.meeting', compact('meetings'));
    }
    // meeting_book
    public function meeting_book(Request $request)
    {
        Invitations::findorfail($request->meeting)->update(['booked' => 1,]);
      
      return back()->with('message', 'Meeting Booked Successfully');
    }
    public function probono()
    {
        $user = auth()->user()->id;
        $probonos = Probono::join('probono_participants', 'probonos.id', '=', 'probono_participants.probono_id')
            ->where('probono_participants.user_id', $user)
            ->select('probonos.*','probonos.id AS probono_id', 'probono_participants.*')
            ->orderby('probonos.created_at', 'desc')->get();
        $categories = Probonocategory::all();
        return view('myprofile.probono', compact('probonos', 'categories'));
    }


    public function probono_details($case)
    {
        $probono = Probono::findorfail($case);
        $probono_devs = Probono_dev::where('probono_id', $case)->orderBy('created_at', 'desc')->get();
        $files = ProbonoFile::where('probono_id', $case)->get();

        return view('myprofile.probono_delails', compact('probono', 'probono_devs', 'files'));
    }
    public function probono_dev(Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
            'title' => 'required',
            'narration' => 'required',
        ]);

        if ($request->hasFile('attach_file')) {
            $file = $request->file('attach_file');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $case_file = date('His') . '-' . $filename;
            $file->move(public_path('assets/img/files'), $case_file);
        } else {
            $case_file = null;
        }

        $probono = Probono::findorfail($request->probono);
        $probono->status = $request->status;
        $probono->save();

        Probono_dev::create([
            'status' => $request->status,
            'title' => $request->title,
            'narration' => $request->narration,
            'attach_file' => $case_file,
            'probono_id' => $request->probono,
            'reportedBy' => auth()->user()->id,
            'reporter_name' => auth()->user()->name,
        ]);

        $probono = Probono::findorfail($request->probono);
        $probono->probono_devs = $probono->probono_devs + 1;
        $probono->comments = $request->narration;
        $probono->save();

        return back()->with('message', 'New Development');
    }
    public function mytraings()
    {
        $advocate = auth()->user()->id;
        $trainings = Training::where('publish', 2)->orderBy('created_at', 'desc')->paginate(10);
        $bookings = Booking::where('advocate', $advocate)->orderBy('created_at', 'desc')->take(5)->get();
        $booked = Booking::where('advocate', $advocate)->pluck('training')->toArray();
        $attendances = Booking::where('advocate', $advocate)->where('attendanceDay', '<>', null)->whereIn('status', [1, 2, 3])->take(5)->get();
        return view('myprofile.training.trainings', compact('trainings', 'bookings', 'booked', 'attendances'));
    }
    public function training_book(Request $request)
    {
        $advocate = auth()->user()->id;

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $yearInBar = ($currentMonth == 1) ? $currentYear - 1 : $currentYear;
        if ($request->price == 0.00) {
            $training = Training::findorfail($request->training);
            $booked = $training->booking;
            $confirmed = $training->confirm;
            $training->booking = $booked + 1;
            $training->confirm = $confirmed + 1;
            $training->save();

            Booking::create(['training' => $request->training, 'advocate' => $advocate,
                'yearInBar' => $yearInBar, 'booked' => true, 'confirm' => true, 'status' => 2]);
        } else {
            $training = Training::findorfail($request->training);
            $booked = $training->booking;
            $training->booking = $booked + 1;
            $training->save();
            Booking::create(['training' => $request->training, 'advocate' => $advocate,
                'yearInBar' => $yearInBar, 'booked' => true, 'status' => 1]);
        }

        return back()->with('message', $training->title . 'Booked');
    }
    public function book_remove(Request $request)
    {
        $booking = Booking::findorfail($request->id);
        $train = $booking->training;
        if ($booking->price == 0.00) {
            $training = Training::findorfail($train);
            $booked = $training->booking;
            $confirmed = $training->confirm;
            $training->booking = $booked - 1;
            $training->confirm = $confirmed - 1;
            $training->save();

        } else {
            $training = Training::findorfail($train);
            $booked = $training->booking;
            $training->booking = $booked - 1;
            $training->save();
        }

        $booking->delete();
        return back()->with('warning', 'Training Removed on List');
    }

    public function mytraings_detail($id)
    {
        $training = Training::findorfail($id);
        $topics = TrainingTopic::where('training_id', $id)->get();
        $materials = TrainingMaterial::where('training_id', $id)->get();

        $advocate = auth()->user()->id;
        $trainings = Training::where('publish', 2)->get();
        $bookings = Booking::where('advocate', $advocate)->get();
        $attendances = Booking::where('advocate', $advocate)->where('attendanceDay', '<>', null)->whereIn('status', [1, 2, 3])->get();
        $booked = Booking::where('advocate', $advocate)->pluck('training')->toArray();

        return view('myprofile.training.trainings-details', compact('trainings', 'bookings', 'booked', 'training', 'topics', 'materials', 'attendances'));
    }
    public function makeAttendence(Request $request)
    {
        $check = Booking::where('training', $request->training)
            ->where('voucherNumber', $request->voucher)->where('advocate', auth()->user()->id)->
            first();
        if ($check) {
            Booking::where('training', $request->training)->where('advocate', auth()->user()->id)
                ->update(['status' => 4,
                    'updated_at' => now()->format('Y-m-d H:i:s'),
                ]);
        } else {
            return back()->with('warning', 'Voucher Number Does not much');
        }
        return back()->with('message', 'Attendance Done');

    }
    public function complaince(Request $request)
    {
        if (isset($request->year)) {
            $year = substr($request->year, 0, 4);
         } else {
             $year = Carbon::now()->year;
         }

        $advocate = auth()->user()->id;
        $user = User::findorfail($advocate);

        $contribution = Contribution::where('yearInBar', $year)->first();
        $complaince = Compliance::where('user_id', $advocate)->where('year',$year)->first();
        return view('myprofile.compliance',compact('user','contribution','complaince'));
    }

    public function userChangePassword(Request $request, User $user)
    {
        $validator = $this->validate($request, [
            'current' => 'required',
            'password' => 'required|min:6',
        ]);

        $user = User::findorfail($user->id);

        $password = $user->password;

        $verified = Hash::check($request->password, $password);  
        if($verified){
            return back()->with('invalid','Current Password and new password can not be the same');
        } 

        $verified = Hash::check($request->current, $password);  
        if(! $verified){
            return back()->with('invalid','Invalid Password, Check password in email');
        }   

        $user->password = Hash::make($request->password);
        $user->save();
        auth()->logout();
        return redirect()->route('login')->with('reseted', 'Password changed! sign in to continue');
    }

}
