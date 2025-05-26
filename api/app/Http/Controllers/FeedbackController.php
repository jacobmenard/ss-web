<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Mail\EmailPusher;
use App\Models\UserEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\FeedbackResource;
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

    public function storeFeedback(Request $request, UserEvent $userEvents, Feedback $feedbacks) {
        $userEvent = $userEvents->where('event_id', $request->eid)
                                ->where('user_id', $request->user_id)
                                ->first();

        $isAlreadyFeedback = $feedbacks->where('user_event_id', $userEvent->id)->first();
        
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

        
        if ($isAlreadyFeedback) {
            $data['isFirstSend'] = false;
        } else {
            $data['isFirstSend'] = true;

            $url = 'https://www.eventbriteapi.com/v3/events/' . $request->eid;
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('EVENTBRITE_API_KEY'),
            ])
            ->acceptJson()
            ->get($url);
            $event = json_decode($response->body());
            
            $feedbackItems['type'] = 'feedback';
            $feedbackItems['user_event_id'] = $userEvent->id;
            $feedbackItems['event_name'] = $event->name->text;
            $feedbackItems['event_url'] = $event->url;
            $feedbackItems['host_points'] = $request->host_points;
            $feedbackItems['host_feedback'] = $request->host_feedback;
            $feedbackItems['venue_points'] = $request->venue_points;
            $feedbackItems['venue_feedback'] = $request->venue_feedback;
            $feedbackItems['event_points'] = $request->event_points;
            $feedbackItems['event_feedback'] = $request->event_feedback;
            $feedbackItems['website_points'] = $request->website_points;
            $feedbackItems['website_feedback'] = $request->website_feedback;
            $feedbackItems['other_feedback'] = $request->other_feedback;

            $feedbackItems['name'] = $request->name;
            $feedbackItems['email'] = $request->email;
            $feedbackItems['subject'] = 'New feedback submitted!';

            Mail::to(env('MAIL_FROM_ADDRESS'))->send(new EmailPusher($feedbackItems));
        }

        if (!$feedbacks) {
            $data['data'] = [];
            $data['message'] = 'Error saving feedback';
            $data['status'] = 'error';

            return error($data);
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

    public function userFeedback(Request $request, Feedback $feedbacks) {
        $pageSize = isset($request->pageSize) ? $request->pageSize : 10;
        $feedbackLists = $feedbacks->with(['event']);

        if (isset($request->eid)) {
            $feedbackLists->whereHas('event', function($q) {
                $q->where('event_id', $request->eid);
            });
        }

        $feedbackLists->orderBy('id', 'desc');

        return FeedbackResource::collection($feedbackLists->paginate($pageSize));
    }
}
