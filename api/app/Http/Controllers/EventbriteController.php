<?php

namespace App\Http\Controllers;

use App\Http\Helper;
use App\Models\User;
use App\Mail\EmailPusher;
use App\Models\UserEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
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

    public function getEventListForCommand(Request $request) {
        $url = 'https://www.eventbriteapi.com/v3/organizations/' . ENV('EVENTBRITE_ORGANIZATION_ID') . '/events';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('EVENTBRITE_API_KEY'),
        ])
        ->acceptJson()
        ->get($url, [
            'order_by' => 'start_asc',
            'page_size' => 5,
            'time_filter' => 'past'
        ]);
        
        $data['events'] = $response['events'];


        
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

            $getUser = User::where('email', $profile['email'])
                            ->where('first_name', $profile['first_name'])
                            ->where('last_name', $profile['last_name'])
                            ->first();
            
            if (!$getUser) {
                $newCreate = User::Create([
                    'eventbrite_id' => $attendee['id'],
                    'first_name' => $profile['first_name'],
                    'last_name' => $profile['last_name'],
                    'gender' => isset($profile['gender']) ? $profile['gender'] : 'male',
                    'age' => $profile['age'],
                    'email' => $profile['email'],
                    'cell_phone' => $profile['cell_phone'],
                    // 'password' => bcrypt(strtolower($profile['first_name']))
                    'password' => bcrypt('123456')
                ]);
                $user_id = $newCreate->id;
            } else {
                $user_id = $getUser->id;
            }
            
            $participants = UserEvent::updateOrCreate([
                'event_id' => $attendee['event_id'],
                'user_id' => $user_id
            ], [
                'gender' => isset($profile['gender']) ? $profile['gender'] : 'male',
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
        $url = 'https://www.eventbriteapi.com/v3/events/' . $request->eid;
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
        $lists = $userEvents->where('user_id', Auth::user()->id)->where('is_checkin', 1)->whereNull('event_status')->pluck('event_id');
        $doneLists = $userEvents->where('user_id', Auth::user()->id)->where('is_checkin', 1)->whereNotNull('event_status')->limit(5)->pluck('event_id');
        
        $url = 'https://www.eventbriteapi.com/v3/organizations/' . ENV('EVENTBRITE_ORGANIZATION_ID') . '/events';
        
        $response = eventBriteRequest()->get($url, [
            'order_by' => 'start_desc',
            'page_size' => 100,
            'time_filter' => 'all'
        ]);
        
        $eventsList = json_decode($response->body());

        $currentFuture = collect($eventsList->events)->whereIn('id', $lists);
        $pastEvents = collect($eventsList->events)->whereIn('id', $doneLists);

        return success([
            'current_future' => $currentFuture->values()->all(),
            'past' => $pastEvents->values()->all()
        ]);
    }

    public function getFiveEvents(Request $request) {
        $userEvents = new UserEvent;
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

        $events = $response['events'];
        $eventIds = collect($events)->pluck('id');

        $userList = $userEvents->whereIn('event_id', $eventIds)->whereNull('event_status');

        // $userList = $userEvents->whereIn('event_id', $eventIds);

        $userToSend = $userList->with(['user'])->get();
        $userToSend = $userToSend->map(function($data) {
            $mapData['subject'] = 'Thank You for Attending Our Speed Dating Event!';
            $mapData['type'] = 'matchup_result_final';
            $mapData['matchup_url'] = env('CLIENT_URL').'/public/match-result/'.$data['user_id'].'?eid='.$data['event_id'];
            $mapData['email'] = $data['user']['email'];
            $mapData['name'] = $data['user']['first_name'];
            $mapData['id'] = $data['id'];
            return $mapData;
        });


        foreach($userToSend as $item) {
            $userEvents->where('id', $item['id'])->update(['event_status' => 'done']);
            Mail::to($item['email'])->send(new EmailPusher($item));
        }
        
        return $userToSend;

        return success($data);
    }
    
}
