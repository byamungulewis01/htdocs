<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Discipline;
use Illuminate\Http\Request;
use App\Models\DisciplineReport;
use App\Exports\DisciplineExport;
use App\Models\CaseNotifyRecords;
use App\Models\DisciplineSitting;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\DisciplineParticipant;

class DisciplinaryController extends Controller
{
    public function index()
    {
    $users = User::where('practicing',2)->get();
    $cases = Discipline::orderby('created_at', 'DESC')->paginate(10);
        return view('cases.index', compact('users', 'cases'));
    }
    public function export()
    {
        return view('cases.export-data');
    }
    public function store(Request $request)
    {
        $code = Discipline::all()->count() + 1;
        $number = 'DC/' . $code . '/' . date('Y');
        if ($request->case_type == 1) {
            $advocate = User::find($request->advocate);
            $name = $advocate->name;
            $email = $advocate->email;
            $case = Discipline::create([
                'p_name' => $request->name,
                'p_email' => $request->email,
                'p_phone' => $request->phone,
                'd_name' => $name,
                'd_email' => $email,
                'd_advocate' => $request->advocate,
                'case_number' => $number,
                'case_type' => $request->case_type,
                'complaint' => $request->complaint,
                'sammary' => $request->sammary,
                'register' => auth()->guard('admin')->user()->id,
            ]);
            DisciplineParticipant::create([
                'discipline_case' => $case->id,
                'advocate' => $request->advocate,
                'role' => 'Plaintiff',
            ]);
            DisciplineSitting::create(
                [
                    'discipline_case' => $case->id,
                    'category' => '',
                    'scheduledBy' => auth()->guard('admin')->user()->id,
                ]
            );
            $message = 'Dear Adv ' . $name . ',' ;
            $message .= 'The new Disciplinary case has been filed by the Rwanda Bar Association Secretariat please log in for further action : http://www.rbamis.rwandabar.rw/ ,' . PHP_EOL;
            $message .= 'RBA Secretariat';
            $subject = 'New Disciplinary Case';
            $attachmentsPaths = [];
            (new NotifyController)->notify_probono($email, $message, $subject, $attachmentsPaths);
        }
        if ($request->case_type == 2) {
            $advocate = User::find($request->advocate);
            $name = $advocate->name;
            $email = $advocate->email;
            $case = Discipline::create([
                'p_name' => $name,
                'p_email' => $email,
                'p_advocate' => $request->advocate,
                'd_name' => $request->name,
                'd_email' => $request->email,
                'd_phone' => $request->phone,
                'case_number' => $number,
                'case_type' => $request->case_type,
                'complaint' => $request->complaint,
                'sammary' => $request->sammary,
                'register' => auth()->guard('admin')->user()->id,
            ]);
            DisciplineParticipant::create([
                'discipline_case' => $case->id,
                'advocate' => $request->advocate,
                'role' => 'Defendant',
            ]);
            DisciplineSitting::create(
                [
                    'discipline_case' => $case->id,
                    'category' => '',
                    'scheduledBy' => auth()->guard('admin')->user()->id,
                ]
            );
            $message = 'Dear Adv ' . $name . ',' ;
            $message .= 'The new Disciplinary case has been filed by the Rwanda Bar Association Secretariat please log in for further action : http://www.rbamis.rwandabar.rw/ ,' . PHP_EOL;
            $message .= 'RBA Secretariat';
            $subject = 'New Disciplinary Case';
            $attachmentsPaths = [];
            (new NotifyController)->notify_probono($email, $message, $subject, $attachmentsPaths);
        }
        if ($request->case_type == 3) {
            if ($request->plaintiff == $request->defendant) {
                return back()->with('warning', 'Please Select difference Advocate');
            } else {

                $plaintiff = User::find($request->plaintiff);
                $p_name = $plaintiff->name;
                $p_email = $plaintiff->email;
                $defendant = User::find($request->defendant);
                $d_name = $defendant->name;
                $d_email = $defendant->email;
                $case = Discipline::create([
                    'p_name' => $p_name,
                    'p_email' => $p_email,
                    'p_advocate' => $request->plaintiff,
                    'd_name' => $d_name,
                    'd_email' => $d_email,
                    'd_advocate' => $request->defendant,
                    'case_number' => $number,
                    'case_type' => $request->case_type,
                    'complaint' => $request->complaint,
                    'sammary' => $request->sammary,
                    'register' => auth()->guard('admin')->user()->id,
                ]);
                DisciplineParticipant::create([
                    'discipline_case' => $case->id,
                    'advocate' => $request->plaintiff,
                    'role' => 'Plaintiff',
                ]);
                DisciplineParticipant::create([
                    'discipline_case' => $case->id,
                    'advocate' => $request->defendant,
                    'role' => 'Defendant',
                ]);
                DisciplineSitting::create(
                    [
                        'discipline_case' => $case->id,
                        'category' => '',
                        'scheduledBy' => auth()->guard('admin')->user()->id,
                    ]
                );
                $message = 'Dear Adv ' . $p_name . ',' ;
                $message .= 'The new Disciplinary case has been filed by the Rwanda Bar Association Secretariat please log in for further action : http://www.rbamis.rwandabar.rw/ ,' . PHP_EOL;
                $message .= 'RBA Secretariat';
                $subject = 'New Disciplinary Case';
                $attachmentsPaths = [];
                (new NotifyController)->notify_probono($p_email, $message, $subject, $attachmentsPaths);

                $message = 'Dear Adv ' . $d_name . ',' ;
                $message .= 'The new Disciplinary case has been filed by the Rwanda Bar Association Secretariat please log in for further action : http://www.rbamis.rwandabar.rw/ ,' . PHP_EOL;
                $message .= 'RBA Secretariat';
                $subject = 'New Disciplinary Case';
                $attachmentsPaths = [];
                (new NotifyController)->notify_probono($d_email, $message, $subject, $attachmentsPaths);
            }

        }

        return back()->with('message', 'Discipline case Added Successfully !!');
    }
    public function update(Request $request)
    {
        if ($request->case_type == 1) {
            $advocate = User::find($request->advocate);
            $name = $advocate->name;
            $email = $advocate->email;
            $discipline = Discipline::findorfail($request->case);
            $discipline->p_name = $request->name;
            $discipline->p_email = $request->email;
            $discipline->p_phone = $request->phone;
            $discipline->d_name = $name;
            $discipline->d_email = $email;
            $discipline->d_advocate = $request->advocate;
            $discipline->complaint = $request->complaint;
            $discipline->sammary = $request->sammary;
            $discipline->register = auth()->guard('admin')->user()->id;
            $discipline->updated_at = date('Y/m/d');
            $discipline->save();

            DisciplineParticipant::where('discipline_case', $request->case)->where('role', 'Plaintiff')
                ->orderBy('created_at')->take(1)->update([
                'advocate' => $request->advocate,
                'updated_at' => date('Y/m/d'),
            ]);
        }
        if ($request->case_type == 2) {
            $advocate = User::find($request->advocate);
            $name = $advocate->name;
            $email = $advocate->email;
            $discipline = Discipline::findorfail($request->case);
            $discipline->d_name = $request->name;
            $discipline->d_email = $request->email;
            $discipline->d_phone = $request->phone;
            $discipline->p_name = $name;
            $discipline->p_email = $email;
            $discipline->p_advocate = $request->advocate;
            $discipline->complaint = $request->complaint;
            $discipline->sammary = $request->sammary;
            $discipline->register = auth()->guard('admin')->user()->id;
            $discipline->updated_at = date('Y/m/d');
            $discipline->save();

            DisciplineParticipant::where('discipline_case', $request->case)->where('role', 'Defendant')
                ->orderBy('created_at')->take(1)->update([
                'advocate' => $request->advocate,
                'updated_at' => date('Y/m/d'),

            ]);
        }
        if ($request->case_type == 3) {
            if ($request->plaintiff == $request->defendant) {

                return back()->with('warning', 'Please Select difference Advocate');
            } else {

                $plaintiff = User::find($request->plaintiff);
                $p_name = $plaintiff->name;
                $p_email = $plaintiff->email;
                $defendant = User::find($request->defendant);
                $d_name = $defendant->name;
                $d_email = $defendant->email;

                $discipline = Discipline::findorfail($request->case);
                $discipline->d_name = $d_name ;
                $discipline->d_email = $d_email;
                $discipline->p_name =$p_name;
                $discipline->p_email = $p_email;
                $discipline->p_advocate = $request->plaintiff;
                $discipline->d_advocate = $request->defendant;
                $discipline->complaint = $request->complaint;
                $discipline->sammary = $request->sammary;
                $discipline->register = auth()->guard('admin')->user()->id;
                $discipline->updated_at = date('Y/m/d');
                $discipline->save();

                DisciplineParticipant::where('discipline_case', $request->case)
                ->where('role', 'Plaintiff')->orderBy('created_at')->take(1)
                ->update([
                'advocate' => $request->plaintiff,
                'updated_at' => date('Y/m/d'),
            ]);
                DisciplineParticipant::where('discipline_case', $request->case)
                ->where('role', 'Defendant')->orderBy('created_at')->take(1)
                ->update([
                'advocate' => $request->defendant,
                'updated_at' => date('Y/m/d'),
            ]);

            }

        }
        return back()->with('message', 'Discipline Case Updated Successfully');
    }
    public function delete(Request $request)
    {
        DisciplineSitting::where('discipline_case',$request->id)->delete();
        DisciplineReport::where('discipline_id',$request->id)->delete();
        DisciplineParticipant::where('discipline_case',$request->id)->delete();
        Discipline::findorfail($request->id)->delete();
        return back()->with('message', 'Disciplinary case Deleted Successfully');
    }

    public function addmember(Request $request)
    {

        $check = DisciplineParticipant::where('advocate',$request->advcate_id)->where('discipline_case',$request->case_id)->count();
        if($check == 0){
            DisciplineParticipant::create([
                'advocate' => $request->advcate_id,
                'discipline_case' => $request->case_id,
                'role' => $request->role,
            ]);
            $user = User::findorfail($request->advcate_id);
            $name = $user->name;
            $email = $user->email;
            $message = 'Dear Adv ' . $name . ', ';
            $message .= 'The new Disciplinary case has been filed by the Rwanda Bar Association Secretariat please log in for further action : http://www.rbamis.rwandabar.rw/ ,' ;
            $message .= 'RBA Secretariat ' ;
            $subject = 'New Disciplinary Case';
            $attachmentsPaths = [];
            (new NotifyController)->notify_discipline($email, $message, $subject, $attachmentsPaths);
        return back()->with('message', 'Participant Added Successfully');
        }
        else{       
        return back()->with('warning', 'Participant is Already on List');
        }
      

    }
    public function deleteparticipant(Request $request)
    {

        $participant = DisciplineParticipant::where('table_id', $request->id);
        $participant->delete();

        return back()->with('message', 'Participant remove Successfully');
    }
    public function sitting(Request $request)
    {
        $sitting = DisciplineSitting::where('discipline_case', $request->id)->get();
        foreach ($sitting as $key) {
            $incase = $key->sittingDay;
        }

        if ($incase == 'NONE') {
            DisciplineSitting::where('discipline_case', $request->id)->update([
                'category' => $request->category,
                'sittingDay' => $request->sittingdate,
                'sittingTime' => $request->sittingtime,
                'sittingVenue' => $request->sittingAvenue,
            ]);

        } else {
            DisciplineSitting::create([
                'category' => $request->category,
                'sittingDay' => $request->sittingdate,
                'sittingTime' => $request->sittingtime,
                'sittingVenue' => $request->sittingAvenue,
                'discipline_case' => $request->id,
                'scheduledBy' => auth()->guard('admin')->user()->id,
            ]);
        }
        $authority = ($request->category == 'Hearing by BATONIER') ? 'BATONIER' 
                 :(($request->category == 'Mediation') ? 'MEDIATION'
                 :(($request->category == 'Disciplinary committee') ? 'DISCIPLINARY COMMITEE' 
                 :(($request->category == 'Inspection') ? 'INSPACTION' : '')));
        Discipline::findorfail($request->id)->update([
            'authority' => $authority,
        ]);

        return back()->with('message', 'Next sitting Setted');
    }
    public function case_status(Request $request)
    {
        if ($request->status == 'closed') {
            $status = 'open';

        } else {
            $status = 'closed';

        }

        $discipline = Discipline::findorfail($request->case_id);
        $discipline->status = $status;
        $discipline->save();
        return back()->with('message', 'Status updates');

    }

    public function api(Request $request)
    {
        $data = Discipline::all();
        if (!$request->expectsJson()) {
            return $data;
        } else {
            return response()->json([
                'success' => true,
                'data' => $data,
            ]);
        }
    }
    public function show($case_id)
    {
        $users = User::where('practicing',2)->get();
        $sittings = DisciplineSitting::where('discipline_case', $case_id)->get();

        $case = Discipline::find($case_id);

        $members = DisciplineParticipant::where('discipline_case', $case_id)->get();
        return view('cases.detail', compact('case', 'users', 'members', 'sittings'));
    }
    // notificationsHistory
    public function notificationsHistory($id)
    {
        $notifyRecords = CaseNotifyRecords::where('case_id', $id)->orderBy('created_at', 'DESC')->get();
        return view('cases.notifyHistory', compact('notifyRecords'));
    }
    // exportExcel
    public function exportExcel()
    {
         $disciplines = Discipline::orderby('created_at', 'DESC')->get();
        $data = [];
        foreach ($disciplines as $key => $discipline) {
            $data[] = [
                'id' => $key + 1,
                'case_number' => $discipline->case_number,
                'complaint' => $discipline->complaint,
                'p_name' => $discipline->p_name,
                'p_email' => $discipline->p_email,
                'p_phone' => $discipline->p_phone,
                'd_name' => $discipline->d_name,
                'd_email' => $discipline->d_email,
                'd_phone' => $discipline->d_phone,
                'authority' => $discipline->authority,
                'case_status' => $discipline->case_status,
                'sammary' => $discipline->sammary,
                'decision' => $discipline->decision,
            ];
        }
        return Excel::download(new DisciplineExport($data), 'Disciplinary.xlsx');  
    } 

   
}
