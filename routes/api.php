<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\ProbonoController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\DisciplinaryController;
use App\Http\Controllers\LawscategoryController;
use App\Http\Controllers\OrganizationController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api'
], function($router){
    Route::get('/search-vertical', [SearchController::class, 'searchVertical']);
    Route::get('/search', [SearchController::class, 'searchApi']);
    Route::get('/lawcat', [LawscategoryController::class, 'index']);

    Route::get('/users/deseacedApi', [UserController::class, 'deseacedApi']);
    Route::get('/users/categoryApi', [UserController::class, 'categoryApi']);
    Route::get('/users/advocates', [UserController::class, 'advocatesApi']);
    Route::get('/users/interns', [UserController::class, 'internsApi']);
    Route::get('/users/struckOffApi', [UserController::class, 'struckOffApi']);
    Route::get('/users/suspendedApi', [UserController::class, 'suspendedApi']);
    Route::get('/users/inactiveApi', [UserController::class, 'inactiveApi']);
    Route::get('/users/deactiveApi', [UserController::class, 'deactiveApi']);
    Route::get('/users/active', [UserController::class, 'active']);
    Route::get('/users/individual', [UserController::class, 'api']);
    Route::get('/users/compliances', [UserController::class, 'users_compliances_api']);

    Route::get('/meetings', [MeetingController::class, 'api']);
    Route::get('/meeting/{meeting}', [MeetingController::class, 'meeting_expo']);
    Route::get('/cases', [DisciplinaryController::class, 'api']);
    Route::get('/probono', [ProbonoController::class, 'api']);
    Route::get('/trainings', [TrainingController::class, 'api']);
    Route::get('/trainings_archive/{id}', [AdminController::class, 'archiveApi']);
    Route::get('/trainings_extra/{id}', [AdminController::class, 'extraApi']);
    Route::get('/users/organization', [OrganizationController::class, 'api']);
    Route::delete('/users/organization/{organization}', [OrganizationController::class, 'destroy']);
    Route::put('/users/individual/{user}', [UserController::class, 'suspend']);
    Route::delete('/users/individual/{user}', [UserController::class, 'destroy']);
   
    // route for test ipa 
    Route::get('/test', function(){
          // Set the request URL

            $phone = '785436135';
            $message = 'Hello World';
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
        // return response()->json([
        //     'message' => 'Welcome to the API'
        // ]);
    });
});
