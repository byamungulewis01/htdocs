<?php

namespace App\Http\Controllers;

use App\Mail\NewEmail;
use App\Mail\NewAccount;
use App\Mail\NotifyUser;
use App\Models\MailSend;
use App\Mail\ChangedEmail;
use App\Mail\MeetingNotify;
use App\Mail\ProboniNotify;
use App\Mail\Quicky_notify;
use App\Mail\resetPassword;
use App\Mail\TrainingNotify;
use Illuminate\Http\Request;
use App\Mail\NewOrganization;
use App\Mail\DisciplineNotify;
use Illuminate\Support\Facades\Mail;

class NotifyController extends Controller
{
    public $message;
    public $phone;
    public $subject;
    public $user;
    public $key;
    public $attachmentsPaths;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function newAccount($email, $password)
    {
        try {
            Mail::to($email)->queue(new NewAccount($email, $password,));
        } catch (\Exception $e) {}

    }

    public function newOrganization($email, $password)
    {
        try {
            Mail::to($email)->queue(new NewOrganization($email, $password,));
        } catch (\Exception $e) {}
       
    }

    // public function newEmail(){
    //     Mail::to($email)->queue(new NewEmail($email));
    // }

    // public function changedEmail(){
    //     Mail::to($email)->queue(new ChangedEmail());
    // }

    public function reset($key, $email)
    {
        try { Mail::to($email)->send(new resetPassword($key, $email));
        } catch (\Exception $e) {}
       
    }
    public function notify_meeting($email, $subject, $message, $attachments)
    {
        try {
            Mail::to($email)->queue(new MeetingNotify($email, $subject, $message, $attachments)); 
        } catch (\Exception $e) {}
       
    }

    public function notify_training($email, $subject, $message)
    {
        try {
             Mail::to($email)->queue(new TrainingNotify($email, $subject, $message));
        } catch (\Exception $e) {}
       
    }

    public function notify($name, $email, $subject, $message, $attachmentsPaths)
    {
        try {
            Mail::to($email)->queue(new NotifyUser($name, $email, $subject, $message, $attachmentsPaths));
        
        } catch (\Exception $e) {
            if ($e->getCode() == 550) {
                $msg = 'Mail not sent, email address does not exist';
            } else { $msg = $e->getMessage(); }
          
            MailSend::create(['name' => $name, 'email' => $email,'message' => $msg ,'status' =>time()]);
        }
    }
    public function quicky_notify($email, $name, $password)
    {
        try {
            Mail::to($email)->queue(new Quicky_notify($email, $name, $password));
        } catch (\Exception $e) {}
        
    }
    public function notify_discipline($email, $subject, $message, $attachments)
    {
        try {
          Mail::to($email)->queue(new DisciplineNotify($email, $subject, $message, $attachments)); 
        } catch (\Exception $e) {}
        
    }
    public function notify_probono($email, $subject, $message, $attachments)
    {
        try {
             Mail::to($email)->queue(new ProboniNotify($email, $subject, $message, $attachments));
        } catch (\Exception $e) {}
       
    }
    public function notify_sms($message, $phone)
    {
        $number = $phone[0]['phone'];

        $url = 'https://api.sms.rw/';

        // Set the message data in JSON format
        $message_data = array(
            'ohereza' => 'RWANDABAR',
            'ubutumwa' => $message,
            'msgid' => 'KA123455',
            'kuri' => '25' . $number,
            'client' => 'rbas',
            'password' => '6p2h9u9u8u2s',
            'receivedlr' => '1',
            'callurl' => 'https://api.sms.rw/',
            'messagetype' => 'flash',
            'retype' => 'xml'
        );

        // Convert the message data to JSON format
        $json_data = json_encode($message_data);

        // Set up the cURL request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($json_data)
        ));

        // Send the request and get the response
        $response = curl_exec($ch);

        // Check for any errors
        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        } else {
            // Print the response
            echo $response;
        }

        // Close the cURL session
        curl_close($ch);
    }
    public function sms($message, $phone)
    {
        $url = 'https://api.sms.rw/';

        // Set the message data in JSON format
        $message_data = array(
            'ohereza' => 'RWANDABAR',
            'ubutumwa' => $message,
            'msgid' => 'KA123455',
            'kuri' => '25' . $phone,
            'client' => 'rbas',
            'password' => '6p2h9u9u8u2s',
            'receivedlr' => '1',
            'callurl' => 'https://api.sms.rw/',
            'messagetype' => 'flash',
            'retype' => 'xml'
        );

        // Convert the message data to JSON format
        $json_data = json_encode($message_data);

        // Set up the cURL request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($json_data)
        ));

        // Send the request and get the response
        $response = curl_exec($ch);

        // Check for any errors
        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        } else {
            // Print the response
            echo $response;
        }

        // Close the cURL session
        curl_close($ch);
    }
}
