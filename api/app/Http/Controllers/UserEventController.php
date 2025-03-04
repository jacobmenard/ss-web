<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserEvent;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
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

    public function getParticipant($id, User $user) {
        $getUser = $user->find($id);
        $message = '';

        if (!$getUser) {
            return error($getUser, 'User not found');
        }

        return success(new UserResource($getUser));
        
    }
}
