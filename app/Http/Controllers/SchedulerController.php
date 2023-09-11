<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Discipline;
use Illuminate\Http\Request;
use App\Models\CaseNotifyRecords;
use App\Models\DisciplineSitting;

class SchedulerController extends Controller
{

    public function add_schedule_decision(Request $request)
    {

        $formDate = $request->validate([
            'desision' => 'required',
            'tagetAdvocate' => 'required',
            'comment' => 'required',
            'attach_file.*' => 'max:10240', // Maximum file size of 10 MB
            'attach_file' => 'max:5' // Maximum of 5 files
        ]);

        $attachmentsPaths = [];
        if ($request->hasFile('attach_file')) {
            foreach ($request->file('attach_file') as $file) {
                $name = $file->getClientOriginalName();
                $attach_file   = date('His') . '-' . $name;
                $file->move(public_path() . '/assets/img/files/', $attach_file);
                $attachmentsPaths[] = $attach_file;
            }
        }
        $attachs = implode(',', $attachmentsPaths);


        DisciplineSitting::where('sitting_id', $request->sittind_id)->update([
            'decisionCategory' => $request->desision,
            'targetedAdvocate' => $request->tagetAdvocate,
            'comment' => $request->comment,
            'attach_file' => $attachs,
            'scheduledBy' => auth()->guard('admin')->user()->id,
        ]);
        if ($request->desision == 'Suspended Advocate') {
            User::where('id', $request->tagetAdvocate)->update([
                'practicing' => 4,
            ]);
        } elseif ($request->desision == 'StruckOff Advocate') {
            User::where('id', $request->tagetAdvocate)->update([
                'practicing' => 5,
            ]);
        }


        if ($request->status == 1) {
            $case = Discipline::findorfail($request->case);
            $case->case_status = 'CLOSED';
            $case->save();
        }
        $caseInfo = Discipline::findorfail($request->case);
        $case_type = $caseInfo->case_type;
        $p_advocate = $caseInfo->p_advocate;
        $d_advocate = $caseInfo->d_advocate;

        $caseInfo->update(['decision' => $request->desision, ]);

        $attachmentsPaths = [];
        if ($case_type == 1) {
            $user = User::find($d_advocate);
            $d_email = $user->email;

            (new NotifyController)->notify_discipline($caseInfo->p_email, "Disciplinary case Decision", $request->comment, $attachmentsPaths);
            (new NotifyController)->notify_discipline($d_email, "Disciplinary case Decision", $request->comment, $attachmentsPaths);
        } elseif ($case_type == 2) {
            $user = User::find($p_advocate);
            $p_email = $user->email;

            (new NotifyController)->notify_discipline($caseInfo->d_email, "Disciplinary case Decision", $request->comment, $attachmentsPaths);
            (new NotifyController)->notify_discipline($p_email, "Disciplinary case Decision", $request->comment, $attachmentsPaths);
        } else {
            $plaintiff = User::find($p_advocate);
            $p_email = $plaintiff->email;

            $defandant = User::find($d_advocate);
            $d_email = $defandant->email;

            (new NotifyController)->notify_discipline($d_email, "Disciplinary case Decision", $request->comment, $attachmentsPaths);
            (new NotifyController)->notify_discipline($p_email, "Disciplinary case Decision", $request->comment, $attachmentsPaths);
        }


        return back()->with('message', 'Decission Added Successfully');
    }

    public function notify(Request $request)
    {
        $formField = $request->validate([
            'party' => 'required',
            'message' => 'required',
            'sent' => 'required',
            'attachments.*' => 'max:10240', // Maximum file size of 10 MB
            'attachments' => 'max:5', // Maximum of 5 files
        ]);

        $attachments = $request->file('attachments');
        $attachmentsPaths = [];
        if ($attachments) {
            foreach ($attachments as $attachment) {
                $path = $attachment->store('attachments');
                $attachmentsPaths[] = $path;
            }
        }
        $sent = implode(',', $request->sent);

        foreach ($request->party as $parti) {
            if ($parti == 'Plaintiffs') {      
                if ($sent == 'EMAIL') {
                    (new NotifyController)->notify_discipline($request->p_email, $request->subject, $request->message, $attachmentsPaths);
                } elseif ($sent == 'SMS') {
                    (new NotifyController)->sms($request->message, $request->p_phone);
                } else {
                    (new NotifyController)->notify_discipline($request->p_email, $request->subject, $request->message, $attachmentsPaths);
                    (new NotifyController)->sms($request->message, $request->p_phone);
                }

                CaseNotifyRecords::create([
                    'case_id' => $request->case_id,
                    'message' => $request->message,
                    'plaintiff_name' => $request->p_name,
                ]);
              
            } elseif ($parti == 'Defendants') {
                if ($sent == 'EMAIL') {
                    (new NotifyController)->notify_discipline($request->d_email, $request->subject, $request->message, $attachmentsPaths);
                } elseif ($sent == 'SMS') {
                    (new NotifyController)->sms($request->message, $request->d_phone);
                } else {
                    (new NotifyController)->notify_discipline($request->d_email, $request->subject, $request->message, $attachmentsPaths);
                    (new NotifyController)->sms($request->message, $request->d_phone);
                }
                CaseNotifyRecords::create([
                    'case_id' => $request->case_id,
                    'message' => $request->message,
                    'defandant_name' => $request->d_name,
                ]);
            } elseif ($parti == 'All') {
                if ($sent == 'EMAIL') {
                    (new NotifyController)->notify_discipline($request->p_email, $request->subject, $request->message, $attachmentsPaths);
                    (new NotifyController)->notify_discipline($request->d_email, $request->subject, $request->message, $attachmentsPaths);
                } elseif ($sent == 'SMS') {
                    (new NotifyController)->sms($request->message, $request->p_phone);
                    (new NotifyController)->sms($request->message, $request->d_phone);
                } else {
                    (new NotifyController)->notify_discipline($request->p_email, $request->subject, $request->message, $attachmentsPaths);
                    (new NotifyController)->notify_discipline($request->d_email, $request->subject, $request->message, $attachmentsPaths);
                    (new NotifyController)->sms($request->message, $request->p_phone);
                    (new NotifyController)->sms($request->message, $request->d_phone);
                }
                CaseNotifyRecords::create([
                    'case_id' => $request->case_id,
                    'message' => $request->message,
                    'plaintiff_name' => $request->p_name,
                    'defandant_name' => $request->d_name,
                ]);
            }
        }
        if ($request->staff) {
         $users = User::wherein('status', $request->staff)->get();
          if ($sent == 'EMAIL') {
                foreach ($users as $user) {
                    (new NotifyController)->notify_discipline($user->email, $request->subject, $request->message, $attachmentsPaths);
                }
            } elseif ($sent == 'SMS') {
                foreach ($users as $user) {
                    (new NotifyController)->notify_sms($request->message, $user->phone);
                }
            } else {
                foreach ($users as $user) {
                    (new NotifyController)->notify_discipline($user->email, $request->subject, $request->message, $attachmentsPaths);
                    (new NotifyController)->notify_sms($request->message, $user->phone);
                }
            } // end of else
        }

  

        return back()->with('message', 'Notified Successfully');
     }
}
