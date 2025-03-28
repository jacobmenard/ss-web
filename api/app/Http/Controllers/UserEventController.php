<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MatchUp;
use App\Models\UserEvent;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\Resources\MatchupResource;
use App\Http\Resources\UserEventResource;

class UserEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
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
    public function show(UserEvent $userEvent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserEvent $userEvent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserEvent $userEvent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserEvent $userEvent)
    {
        //
    }

    public function getEvents(Request $request, UserEvent $userEvent) {

        $url = 'https://www.eventbriteapi.com/v3/events/' . $request->eventId . '/ticket_classes/';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('EVENTBRITE_API_KEY'),
        ])
        ->acceptJson()
        ->get($url);

        $resData = json_decode($response->body());

        
        if (count($resData->ticket_classes) == 2) {
            // get opposite gender
            $oppositeGender = Auth::user()->gender == 'male' ? 'female' : 'male';
            $userEvents = $userEvent->with('user')
                                ->whereHas('user', function($q) use ($oppositeGender) {
                                    $q->where('gender', $oppositeGender);
                                })
                                ->where('event_id', $request->eventId)->get();
        } else {
            $userEvents = $userEvent->with('user')
                                ->where('event_id', $request->eventId)->get();
        }



        return success(UserEventResource::collection($userEvents));
    }

    public function getParticipant($id, $eventId, MatchUp $matchUp, User $user) {
        $getUser = $matchUp->with('matchup_user')
                            ->where('event_id', $eventId)
                            ->where('matchup_id', $id)
                            ->where('user_id', Auth::user()->id)
                            ->first();
        $message = '';

        if (!$getUser) {
            $matchup_user = $user->find($id);
            $data = [
                'matchup_user' => new UserResource($matchup_user),
            ];

            return success($data);
        }

        return success(new MatchupResource($getUser));
        
    }

    public function addUserStatus(Request $request, MatchUp $matchUps) {

        $user = Auth::user();
        
        $addStatus = $matchUps->updateOrCreate([
                'user_id' => $user->id,
                'event_id' => $request->event_id,
                'matchup_id' => $request->matchup_id
            ], [
                'matchup_status' => $request->matchup_status,
                'matchup_notes' => $request->matchup_notes
            ]
        );

        if ($addStatus) {
            return success($addStatus, 'Matchup status successfully saved.');
        } else {
            return error([], 'Error on giving matchup Status.');
        }
        
    }

    public function getUserEvent(Request $request, UserEvent $userEvents) {
        $userEvent = $userEvents->where('event_id', $request->event_id)
                                ->where('user_id', $request->user_id)
                                ->first();
        if (!$userEvent) {
            return error([], 'User event not found');
        }
        return success($userEvent);
    }

    public function updateShareContact(Request $request, UserEvent $userEvents) {
        $userEvent = $userEvents->where('event_id', $request->event_id)
                                ->where('user_id', $request->user_id)
                                ->update([
                                    'is_share_contact' => $request->is_share_contact
                                ]);

        if ($userEvent) {
            return success($userEvent, 'Successfully updated');
        } else {
            
            return error([], 'User event unsuccessfully update.');
        }

    }

    public function getEventAttendees(Request $request, UserEvent $userEvents) {
        $participants = $userEvents->where('event_id', $request->eid)
                        ->get();
        $data = UserEventResource::collection($participants);
        return success($data, '');
    }

    public function addUserEvent(Request $request, UserEvent $userEvents, User $users) {
        $user = $users->where('email', $request->email)
                    ->where('first_name', $request->first_name)
                    ->where('last_name', $request->last_name);

        $isExist = $user->count();

        if ($isExist) {
            return success([], 'Attendees already exist', 'error');
        }

        $addUser = $users->create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'age' => $request->age,
            'cell_phone' => $request->cell_phone,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        if ($request->eid) {
            $userEvent = $userEvents->create([
                'event_id' => $request->eid,
                'user_id' => $addUser->id,
                'is_share_contact' => 0
            ]);
            return success(new UserEventResource($userEvent), 'Attendee successfully added!');
        } else {
            
            return success('', 'Attendee successfully added!');
        }

    }

    public function addUserToThisEvent(Request $request, UserEvent $userEvents) {

        $checkUserEvent = $userEvents->where('event_id', $request->eid)
                                    ->where('user_id', $request->user_id)
                                    ->first();

        if ($checkUserEvent) {
            return success('', 'User already added for this event.', 'error');
        }

        $userEvent = $userEvents->create([
            'event_id' => $request->eid,
            'user_id' => $request->user_id
        ]);

        return success('', 'User successfully added for this event');
    }

}
