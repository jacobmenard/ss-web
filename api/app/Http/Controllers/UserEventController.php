<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MatchUp;
use App\Mail\EmailPusher;
use App\Models\UserEvent;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
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

        return $userEvent;
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

        $isAllGender = isset($request->isAllGender) ? $request->isAllGender : 0;

        $url = 'https://www.eventbriteapi.com/v3/events/' . $request->eventId . '/ticket_classes/';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('EVENTBRITE_API_KEY'),
        ])
        ->acceptJson()
        ->get($url);

        $resData = json_decode($response->body());

        if (!$isAllGender) {
            if (count($resData->ticket_classes) == 2) {
                // get opposite gender
                $oppositeGender = Auth::user()->gender == 'male' ? 'female' : 'male';
                $userEvents = $userEvent->with('user')
                                    ->whereHas('user', function($q) use ($oppositeGender) {
                                        $q->where('gender', $oppositeGender);
                                    })
                                    ->where('is_checkin', 1)
                                    ->where('event_id', $request->eventId)->get();
            } else {
                $userEvents = $userEvent->with('user')
                                    ->where('is_checkin', 1)
                                    ->where('user_id', '<>', Auth::user()->id)
                                    ->where('event_id', $request->eventId)->get();
            }
        } else {
            
            $userEvents = $userEvent->with('user')
                                ->where('is_checkin', 1)
                                ->where('user_id', '<>', Auth::user()->id)
                                ->where('event_id', $request->eventId)->get();
        }



        return success(UserEventResource::collection($userEvents));
    }

    public function getParticipant($id, $eventId, MatchUp $matchUp, User $user) {
        $matchup_user = $user->find($id);
        $data = [
            'matchup_user' => new UserResource($matchup_user),
        ];
        
        $getUser = $matchUp->with('matchup_user')
                            ->where('event_id', $eventId)
                            ->where('matchup_id', $id)
                            ->where('user_id', Auth::user()->id)
                            ->get();
        $message = '';

        $data['match_feedback'] = $getUser;
        
        return success($data);
        
    }

    public function addUserStatus(Request $request, MatchUp $matchUps) {

        $user = Auth::user();

        $userId = isset($request->user_id) ? $request->user_id : $user->id;
        $matchStatuses = collect($request->matchup_status);

        //get all current matchup
        $currentMatches = $matchUps->where('user_id', $userId)
                                    ->where('event_id', $request->event_id)
                                    ->where('matchup_id', $request->matchup_id);

        //remove all current feedback
        $matchUps->destroy($currentMatches->pluck('id'));
        
        //re insert data
        foreach($matchStatuses as $matchStatus) {
            $matchUps->create([
                'user_id' => $userId,
                'event_id' => $request->event_id,
                'matchup_id' => $request->matchup_id,
                'matchup_status' => $matchStatus,
                'matchup_notes' => $request->matchup_notes
            ]);
        }

        if ($matchUps) {
            return success($matchUps, 'Matchup status successfully saved.');
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
        $participants = $userEvents->with(['user'])
                        ->where('event_id', $request->eid)
                        ->get()
                        ->sortBy('user.first_name');
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

    public function matchformResult(Request $request) {

        // $userId = Auth::user()->id;
        $matchUps = new MatchUp;
        $userId = $request->user_id;

        $allMatchups = collect($matchUps->where('event_id', $request->eid)->get());

        $myMatchup = $matchUps->with(['matchup_owner', 'matchup_user'])
                            // ->where('user_id', $userId)
                            ->where('matchup_id', $userId)
                            ->where('event_id', $request->eid)
                            // ->where('matchup_status', '<>', 1)
                            ->orderBy('matchup_status', 'desc')
                            ->get();

        if (isset($request->type) && $request->type == 'final_result') {
            $myMatchup = $matchUps->with(['matchup_owner', 'matchup_user'])
            // ->where('user_id', $userId)
            ->where('matchup_id', $userId)
            ->where('event_id', $request->eid)
            // ->where('matchup_status', '<>', 1)
            ->orderBy('matchup_status', 'desc')
            // ->groupBy('user_id')
            ->get();
        } else {
            $myMatchup = $matchUps->with(['matchup_owner', 'matchup_user'])
            ->where('user_id', $userId)
            ->where('event_id', $request->eid)
            ->orderBy('matchup_status', 'desc')
            // ->groupBy('matchup_id')
            ->get();
        }

        $hasFeedback = $myMatchup->pluck('user_id');  

        $matchUpResult = $myMatchup->map(function($item) use ($allMatchups, $request) {
            $matchUpProfile = '';
            $matchFeedbackList = $allMatchups->where('user_id', $item->matchup_id)
                                        ->where('matchup_id', $item->user_id);
            $matchupUser = $matchFeedbackList->first();


            if ($matchupUser) {
                $item->matchup_user_to_owner = $matchupUser->matchup_status ? $matchupUser->matchup_status : 1;
                $item->matchup_user_to_owner_notes = $matchupUser->matchup_notes;
            } else {
                
                $item->matchup_user_to_owner = 1;
                $item->matchup_user_to_owner_notes = null;
            }

            $matchList = [];
            
            foreach($matchFeedbackList as $matches) {
                $matchList[] = $matches;
            }

            $item->matchList = $matchList;

            if (isset($request->type) && $request->type == 'final_result') {
                if ($item->matchup_status == 3 && $item->matchup_user_to_owner == 3) {
                    $item->matchup_final = 3;
                } else if ($item->matchup_status == 4 && $item->matchup_user_to_owner == 4) {
                    $item->matchup_final = 4;
                } else if ($item->matchup_status == 1 || $item->matchup_user_to_owner == 1) {
                    $item->matchup_final = 1;
                } else {
                    $item->matchup_final = 2;
                }
            } else {
                $item->matchup_final = $item->matchup_status;
            }

            $item->matchup_owner->profile_picture = ENV('AWS_S3_BUCKET_URI') . $item->matchup_owner->profile_image;
            $item->matchup_user->profile_picture = ENV('AWS_S3_BUCKET_URI') . $item->matchup_user->profile_image;

            if ($item->matchup_user_to_owner != 1) {
                $item->matchup_share_contact = 1;
            } else {
                $matchupUserEvent = UserEvent::where('event_id', $request->eid)->where('user_id', $item->user_id)->first();
                $item->matchup_user_event = $matchupUserEvent;
                $item->matchup_share_contact = $matchupUserEvent->is_share_contact;
            }

            return $item;
        });


        if (isset($request->sendEmail) && $request->sendEmail) {
            $data['subject'] = 'Thank You for Attending Our Speed Dating Event!';
            $data['type'] = 'matchup_result';
            // $data['matchup_url'] = env('CLIENT_URL').'/match-form/listview/?eid='.$request->eid;
            $data['matchup_url'] = env('CLIENT_URL').'/public/match-result/'.$data['user_id'].'?eid='.$data['event_id'].'&type=your_selection';
            // $data['result'] = $matchUpResult;
            $data['name'] = $request->name;
            Mail::to($request->email)->send(new EmailPusher($data));
            return success($data, '');

            // return view("mail.matchup-result")->with('data', $data);

        } else if (isset($request->urlForm) && $request->urlForm) {
            $url = 'https://www.eventbriteapi.com/v3/events/' . $request->eid ;
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('EVENTBRITE_API_KEY'),
            ])
            ->acceptJson()
            ->get($url);

            $userEvent = UserEvent::where('event_id', $request->eid)->where('user_id', $userId)->first();
            $user = User::find($userId);
            $user->profile_image = ENV('AWS_S3_BUCKET_URI') . $user->profile_image;
            $noSelection = UserEvent::where('user_id', '<>', $userId)->whereNotIn('user_id', $hasFeedback)->where('event_id', $request->eid)->where('is_checkin', 1)->get();


            $event = json_decode($response->body());
            $data['result'] = $matchUpResult;
            $data['event'] = $event;
            $data['user_event'] = $userEvent;
            $data['user'] = $user;
            $data['noSelection'] = UserEventResource::collection($noSelection);
            return success($data, '');

        }
        return success($matchUpResult, '');
    }
    
    public function publicMatchResult(Request $request) {
        $user_id = $request->user_id;
        $eid = $request->eid;
    }

    public function checkinUser(Request $request, UserEvent $userEvents, $userId) 
    {
        //

        $userEvent = $userEvents->find($userId);

        if ($userEvent) {
            $userEvent->is_checkin = $request->checkin;
            $userEvent->save();

            return success($userEvent, 'Selected user successfully checked in now.');
        } else {
            return success([], 'User event not found', 'error');
        }

    }

    public function sendSelectionEmail(Request $request, UserEvent $userEvents) {
        $eid = $request->eid;
        // $eid = '1256470921349';

        $userEventList = $userEvents->with('user')
                                    ->where('event_id', $eid)
                                    ->where('is_checkin', 1)
                                    ->get();

        foreach($userEventList as $item) {
            $data['subject'] = 'Thank You for Attending Our Speed Dating Event!';
            $data['type'] = 'matchup_result';
            $data['matchup_url'] = env('CLIENT_URL').'/public/match-result/'.$item['user_id'].'?eid='.$item['event_id'].'&type=your_selection';
            $data['name'] = $item['user']['first_name'];
            $data['email'] = $item['user']['email'];
            $email = $item['user']['email'];
            Mail::to($email)->send(new EmailPusher($data));
            
        }

        return success($data, 'Attendee selection email has beeen sent.');
    }

    public function getAllMatchParticipants(Request $request, UserEvent $userEvent, MatchUp $matchUps) {
        $url = 'https://www.eventbriteapi.com/v3/events/' . $request->eid . '/ticket_classes/';
        
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('EVENTBRITE_API_KEY'),
        ])
        ->acceptJson()
        ->get($url);

        $resData = json_decode($response->body());

        if (count($resData->ticket_classes) == 2) {

            // get opposite gender
            $oppositeGender = $request->gender == 'male' ? 'female' : 'male';
            $userEvents = $userEvent->with('user')
                                ->whereHas('user', function($q) use ($oppositeGender) {
                                    $q->where('gender', $oppositeGender);
                                })
                                // ->where('is_checkin', 1)
                                ->where('event_id', $request->eid)->get();
        } else {
            $userEvents = $userEvent->with('user')
                                // ->where('is_checkin', 1)
                                ->where('event_id', $request->eid)->get();
        }

        $userEvents->map(function($item) use ($request, $matchUps) {
            $selection = $matchUps->where('user_id', $request->user_id)
                                            ->where('matchup_id', $item->user_id)
                                            ->where('event_id', $request->eid)
                                            ->get();

            $item->matchFeedback = $selection;
            // if ($selection) {
            //     $item->matchFeedback = $selection->matchup_status;
            // } else {
            //     $item->matchFeedback = null;
            // }

            return $item;
        });
        
        return success($userEvents);
    }

    public function updateSelection(Request $request, MatchUp $matchUps) {
        $selections = $request->selections;
        foreach ($selections as $selection) {
            # code...

            $matchUps->updateOrCreate([
                'event_id' => $request->eid,
                'user_id' => $request->user_id,
                'matchup_id' => $selection['id']
            ], [
                'matchup_status' => $selection['matchup_status']
            ]);

            
        }

        return success([], 'Selections successfully updated');
    }

    public function getIndividualResult(Request $request, UserEvent $userEvent) {
        $userId = isset($request->user_id) ? $request->user_id : '';
        $eid = isset($request->eid) ? $request->eid : '';

        $data = $userEvent->with(['user'])->where('event_id', $eid)->where('user_id', $userId)->first();

        if ($data) {

            $selectedUser['subject'] = 'Your Sips & Sparks Matches Are Here!';
            $selectedUser['type'] = 'matchup_result_final';
            $selectedUser['matchup_url'] = env('CLIENT_URL').'/public/match-result/'.$data['user_id'].'?eid='.$data['event_id'].'&type=final_result';
            $selectedUser['email'] = $data['user']['email'];
            $selectedUser['name'] = $data['user']['first_name'];
            $selectedUser['id'] = $data['id'];

            Mail::to($selectedUser['email'])->send(new EmailPusher($selectedUser));
            
            return success([], 'Successfully send match result');
        } else {
            return success([], 'Error, selected user not found', 'error');
        }

        

    }

}
