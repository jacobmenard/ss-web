<?php

use App\Mail\EmailPusher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\UserEventController;
use App\Http\Controllers\EventbriteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware('auth:sanctum')->group(function() {
//     Route::prefix('/v1')->group(function() {
//         Route::resource('/user', UserController::class);
//     });
// });
Route::middleware('auth:sanctum')->group(function() {
    Route::prefix('/v1')->group(function() {
        Route::get('/user', [UserController::class, 'index']);
        Route::prefix('/event')->group(function() {
            Route::get('/participants', [UserEventController::class, 'getEvents']);
            Route::get('/participant/{id}/{eventId}', [UserEventController::class, 'getParticipant']);
            Route::get('/participant-event-list', [EventbriteController::class, 'participantsListOfEvents']);
            Route::post('/participant/add_status', [UserEventController::class, 'addUserStatus']);
            Route::post('/update_status', [UserEventController::class, 'updateShareContact']);
            Route::get('/selected', [UserEventController::class, 'getUserEvent']);
            Route::get('/attendees', [UserController::class, 'getParticipants']);
            Route::post('/add-to-event', [UserEventController::class, 'addUserToThisEvent']);
        });
    });
});


Route::prefix('v1')->group(function() {
    Route::prefix('/eventbrite')->group(function() {
        Route::get('/event-list', [EventbriteController::class, 'getEventList']);
        Route::get('/event-participants', [EventbriteController::class, 'getAttendees']);
        Route::get('/event-object', [EventbriteController::class, 'getEventObject']);
        Route::get('/event-attendees-list', [UserEventController::class, 'getEventAttendees']);
        Route::post('/event-add-attendee', [UserEventController::class, 'addUserEvent']);
    });

    
    Route::get('/feedback', [FeedbackController::class, 'storeFeedback']);
    Route::get('/get-feedback', [FeedbackController::class, 'getFeedback']);


    Route::get('/testing-email', function(Request $request) {

        $data['type'] = 'contactus-business';
        $data['subject'] = 'Excited about your venue for our speed dating events!';
        $data['name'] = $request->name;
        
        Mail::to($request->email)->send(new EmailPusher($data));
    });

    Route::prefix('/contact-us')->group(function() {
        Route::get('send-email', [ContactUsController::class, 'sendEmail']);
    });
});
