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
use Illuminate\Support\Facades\Storage;
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
        return success(new UserEventResource($userEvent));
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
        if (!$request->isUpdate || $request->isUpdate == 'false') {
            $user = $users->where('email', $request->email)
                        ->where('first_name', $request->first_name)
                        ->where('last_name', $request->last_name);

            $isExist = $user->count();

            if ($isExist) {
                return success([], 'Attendees already exist', 'error');
            }

            if ($request->hasFile('profile_image')) {
                $path = Storage::disk('local')->put('attendees', $request->profile_image);
            } else {
                $path = null;
            }

            $addUser = $users->create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'age' => $request->age,
                'cell_phone' => $request->cell_phone,
                'email' => $request->email,
                // 'password' => bcrypt($request->password),
                'password' => bcrypt('123456'),
                'profile_image' => $path
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
        } else {
            
            $user = $users->find($request->id);

            if ($user) {
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->gender = $request->gender;
                $user->cell_phone = $request->cell_phone;
                $user->email = $request->email;
                $user->age = $request->age;
                $user->save();
                return success('', 'Attendee successfully updated!');
            } else {
                return success('', 'Error on updating attendees data!', 500);
            }
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

    // Example 1 for matchup
    // public function matchformResult(Request $request, UserEvent $userEvent, MatchUp $matchUps) {
    //     $url = 'https://www.eventbriteapi.com/v3/events/' . $request->eid . '/ticket_classes/';

    //     $response = Http::withHeaders([
    //         'Authorization' => 'Bearer ' . env('EVENTBRITE_API_KEY'),
    //     ])
    //     ->acceptJson()
    //     ->get($url);

    //     $resData = json_decode($response->body());

        
    //     if (count($resData->ticket_classes) == 2) {
    //         // get opposite gender
    //         // $oppositeGender = Auth::user()->gender == 'male' ? 'female' : 'male';
    //         $oppositeGender = 'male';
    //         $userEvents = $userEvent->with('user')
    //                             ->whereHas('user', function($q) use ($oppositeGender) {
    //                                 $q->where('gender', $oppositeGender);
    //                             })
    //                             ->where('event_id', $request->eid)->get();
    //     } else {
    //         $userEvents = $userEvent->with('user')
    //                             ->where('event_id', $request->eid)->get();
    //     }

    //     $allMatchups = collect($matchUps->where('event_id', $request->eid)->get());

    //     $userEvents->map(function($item) use ($allMatchups) {
    //         $item->userId = 103;
    //         $ownerToMatchup = $allMatchups->where('user_id', $item->userId)
    //                                         ->where('matchup_id', $item->user_id)->first();
    //         $matchupToOwner = $allMatchups->where('user_id', $item->user_id)
    //                                         ->where('matchup_id', $item->userId)->first();
    //         $item->owner_to_matchup_info = $ownerToMatchup;
    //         $item->matchup_to_owner_info = $matchupToOwner;
    //         return $item;
    //     });
    //     return $userEvents;
    // }

    public function matchformResult(Request $request, MatchUp $matchUps) {

        // $userId = Auth::user()->id;
        $userId = $request->user_id;
        $allMatchups = collect($matchUps->where('event_id', $request->eid)->get());

        $myMatchup = $matchUps->with(['matchup_owner', 'matchup_user'])
                            // ->where('user_id', $userId)
                            ->where('matchup_id', $userId)
                            ->where('event_id', $request->eid)
                            ->orderBy('matchup_status', 'desc')
                            ->get();


        $matchUpResult = $myMatchup->map(function($item) use ($allMatchups) {
            $matchupUser = $allMatchups->where('user_id', $item->matchup_id)
                                        ->where('matchup_id', $item->user_id)->first();
                                        
            if ($matchupUser) {
                $item->matchup_user_to_owner = $matchupUser->matchup_status;
                $item->matchup_user_to_owner_notes = $matchupUser->matchup_notes;
            } else {
                
                $item->matchup_user_to_owner = null;
                $item->matchup_user_to_owner_notes = null;
            }

            $item->matchup_owner->profile_image = config('app.url') . '/storage/' . $item->matchup_owner->profile_image;
            $item->matchup_user->profile_image = config('app.url') . '/storage/' . $item->matchup_user->profile_image;

            return $item;
        });

        return success($matchUpResult, '');
    }

}
