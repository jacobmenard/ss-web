<?php

use App\Mail\EmailPusher;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
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
    return new UserResource($request->user());
});

// Route::middleware('auth:sanctum')->group(function() {
//     Route::prefix('/v1')->group(function() {
//         Route::resource('/user', UserController::class);
//     });
// });
Route::middleware('auth:sanctum')->group(function() {
    Route::prefix('/v1')->group(function() {
        Route::get('/user', [UserController::class, 'index']);
        Route::post('/upload-user-image', [UserController::class, 'uploadParticipantsImage']);
        Route::post('/change-password', [UserController::class, 'changeUserPassword']);
        Route::prefix('/event')->group(function() {
            Route::get('/participants', [UserEventController::class, 'getEvents']);
            Route::get('/participant/{id}/{eventId}', [UserEventController::class, 'getParticipant']);
            Route::get('/participant-event-list', [EventbriteController::class, 'participantsListOfEvents']);
            Route::post('/participant/add_status', [UserEventController::class, 'addUserStatus']);
            Route::post('/update_status', [UserEventController::class, 'updateShareContact']);
            Route::get('/selected', [UserEventController::class, 'getUserEvent']);
            Route::get('/attendees', [UserController::class, 'getParticipants']);
            Route::post('/add-to-event', [UserEventController::class, 'addUserToThisEvent']);
            Route::get('/matchform-result', [UserEventController::class, 'matchformResult']);
            Route::post('/checkin/{userId}', [UserEventController::class, 'checkinUser']);
        });
        Route::put('/user/{user}', [UserController::class, 'update']);
    });
});


Route::prefix('v1')->group(function() {
    Route::prefix('/eventbrite')->group(function() {
        Route::get('/event-list', [EventbriteController::class, 'getEventList']);
        Route::get('/event-list-five', [EventbriteController::class, 'getFiveEvents']);
        Route::get('/event-participants', [EventbriteController::class, 'getAttendees']);
        Route::get('/event-object', [EventbriteController::class, 'getEventObject']);
        Route::get('/event-attendees-list', [UserEventController::class, 'getEventAttendees']);
        Route::post('/event-add-attendee', [UserEventController::class, 'addUserEvent']);
    });

    
    Route::get('/feedback', [FeedbackController::class, 'storeFeedback']);
    Route::get('/get-feedback', [FeedbackController::class, 'getFeedback']);


    Route::get('/testing-email', function(Request $request) {

        $data['subject'] = 'Thank You for Attending Our Speed Dating Event!';
        $data['type'] = 'matchup_result_final';
        $data['matchup_url'] = env('CLIENT_URL').'/public/match-result/12?eid=12345678&type=final_result';
        $data['email'] = 'jemenard082713@gmail.com';
        $data['name'] = 'Menard';
        $data['id'] = 1;
        
        Mail::to($data['email'])->send(new EmailPusher($data));
    });

    Route::prefix('/contact-us')->group(function
    () {
        Route::get('send-email', [ContactUsController::class, 'sendEmail']);
    });

    Route::get('/matchform-result', [UserEventController::class, 'matchformResult']);
    Route::post('/forgot-password', [UserController::class, 'forgotPassword']);
    Route::post('/reset-password', [UserController::class, 'publicChangeUserPassword']);
    // Route::prefix('/public')->group(function() {
    //     Route::get('match-result-final', [UserEventController::class, 'publicMatchResult']);
    // });
});
