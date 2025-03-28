<?php

namespace App\Http\Controllers;

use App\Http\Helper;
use App\Models\User;
use App\Models\UserEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\Resources\UserEventResource;

class EventbriteController extends Controller
{
    //

    public function getEventList(Request $request) {
        $url = 'https://www.eventbriteapi.com/v3/organizations/' . ENV('EVENTBRITE_ORGANIZATION_ID') . '/events';
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('EVENTBRITE_API_KEY'),
        ])
        ->acceptJson()
        ->get($url, [
            'order_by' => $request->order_by,
            'page_size' => $request->page_size,
            'time_filter' => $request->time_filter
        ]);
        
        $data['events'] = $response['events'];
        $data['pagination'] = $response['pagination'];
        
        return success($data);
    }

    public function getAttendees(Request $request) {
        $url = 'https://www.eventbriteapi.com/v3/events/' . $request->eid . '/attendees';
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('EVENTBRITE_API_KEY'),
        ])
        ->acceptJson()
        ->get($url);

        $attendees = $response['attendees'];
        
        foreach($attendees as $attendee) {
            $profile = $attendee['profile'];
            $newUpdateCreate = User::updateOrCreate([
                'eventbrite_id' => $attendee['id'],
            ], [
                'eventbrite_id' => $attendee['id'],
                'first_name' => $profile['first_name'],
                'last_name' => $profile['last_name'],
                'gender' => $profile['gender'],
                'age' => $profile['age'],
                'email' => $profile['email'],
                'cell_phone' => $profile['cell_phone'],
                // 'password' => bcrypt(strtolower($profile['first_name']))
                'password' => bcrypt('123456')
            ]);
            
            $participants = UserEvent::updateOrCreate([
                'event_id' => $attendee['event_id'],
                'user_id' => $newUpdateCreate->id
            ], [
                'status' => 'active'
            ]);
        }

        // $data['data']['attendees'] = $attendees;
        // $data['data']['pagination'] = $response['pagination'];

        $data = UserEvent::with(['user', 'feedbacks'])
                        ->where('event_id', $request->eid)
                        ->get();
        
        return success(UserEventResource::collection($data), '');
    }

    public function getEventObject(Request $request) {
        $url = 'https://www.eventbriteapi.com/v3/events/' . $request->eid ;
        $ticketUrl = 'https://www.eventbriteapi.com/v3/events/' . $request->eid . '/ticket_classes';
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('EVENTBRITE_API_KEY'),
        ])
        ->acceptJson()
        ->get($url);

        $Ticketresponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('EVENTBRITE_API_KEY'),
        ])
        ->acceptJson()
        ->get($ticketUrl);

        $event = json_decode($response->body());

        
        $data['data'] = $event;
        $data['ticket_classes'] = $Ticketresponse['ticket_classes'];
        $data['message'] = '';
        $data['status'] = 'success';
        
        return $data;
    }

    public function participantsListOfEvents(UserEvent $userEvents) {
        $lists = $userEvents->where('user_id', Auth::user()->id)->pluck('event_id');

        $url = 'https://www.eventbriteapi.com/v3/organizations/' . ENV('EVENTBRITE_ORGANIZATION_ID') . '/events';
        $response = eventBriteRequest()->get($url, [
            'order_by' => 'start_asc',
            'page_size' => 20,
            'time_filter' => 'current_future'
        ]);

        $response = json_decode($response->body());
        $events = $response->events;
        $eventLists = collect($events)->whereIn('id', $lists);
        return success($eventLists);
    }
    
}
