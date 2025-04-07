<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\UserEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserEventController;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feedback $feedback)
    {
        //
    }

    public function storeFeedback(Request $request, UserEvent $userEvents, Feedback $feedbacks, UserEventController $userEventController) {
        $userEvent = $userEvents->where('event_id', $request->eid)
                                ->where('user_id', $request->user_id)
                                ->first();

        $data['data'] = $feedbacks->updateOrCreate([
            'user_event_id' => $userEvent->id
        ], [
            'host_points' => $request->host_points,
            'host_feedback' => $request->host_feedback,
            'venue_points' => $request->venue_points,
            'venue_feedback' => $request->venue_feedback,
            'event_points' => $request->event_points,
            'event_feedback' => $request->event_feedback,
            'website_points' => $request->website_points,
            'website_feedback' => $request->website_feedback,
            'other_feedback' => $request->other_feedback
        ]);

        $isAlreadyFeedback = $feedbacks->where('user_event_id', $userEvent->id)->first();

        if (!$feedbacks) {
            $data['data'] = [];
            $data['message'] = 'Error saving feedback';
            $data['status'] = 'error';

            return error($data);
        }

        if (!$isAlreadyFeedback) {
            $requestData['sendEmail'] = true;
            $requestData['user_id'] = $request->id;
            $requestData['eid'] = $request->eid;
            $requestData['email'] = $request->email;
            $data['emailData'] = $userEventController->matchformResult($requestData);
        }

        $data['status'] = 'success';
        $data['message'] = 'Event feedback successfully saved';

        return success($data);
    }

    public function getFeedback(Request $request, UserEvent $userEvents, Feedback $feedbacks) {
        $userEvent = $userEvents->where('event_id', $request->eid)
                                ->where('user_id', $request->user_id)
                                ->first();

        $data['data'] = $feedbacks->where('user_event_id', $userEvent->id)->first();

        if (!$data['data']) {
            $data['data'] = [];
            $data['message'] = 'Error retrieving feedback';
            $data['status'] = 'error';

            return error($data);
        }

        $data['status'] = 'success';
        $data['message'] = '';

        return success($data);
    }
}
