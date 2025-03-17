<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MatchUp;
use App\Models\UserEvent;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
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

        $userEvents = $userEvent->with('user')
                            ->where('event_id', $request->eventId)->get();

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

}
