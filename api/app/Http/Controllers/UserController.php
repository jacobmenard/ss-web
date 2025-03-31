<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new UserResource(Auth::user());
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getParticipants(Request $request) {

        $usersList = new User;

        if ($request->search) {
            $usersList = $usersList->where('email', 'like', '%' . $request->search . '%')
                                    ->orWhere('first_name', 'like', '%' . $request->search . '%')
                                    ->orWhere('last_name', 'like', '%' . $request->search . '%');
                                    
        }

        $usersList = $usersList->orderBy('first_name')->orderBy('last_name')->get();

        return success(UserResource::collection($usersList), '');
    }

    
    public function uploadParticipantsImage(Request $request, User $users) {
        $user = $users->find(Auth::user()->id);

        if (!$user) {
            return success([], 'Error on uploading image', 'error');
        }

        if ($request->hasFile('profile_image')) {
            $path = Storage::disk('local')->put('attendees', $request->profile_image);
            
            $user->profile_image = $path;
            $user->save();
        }


        return success(new UserResource($user), 'User image successfully uploaded!');

    }

    public function changeUserPassword(Request $request, User $users) {
        $user = $users->find(Auth::user()->id);

        if (!$user) {
            return success([], 'Error on changing user password', 'error');
        }

        $user->password = bcrypt($request->password);
        $user->is_changed_password = 1;
        $user->save();

        return success(new UserResource($user), 'User password successfully changed!');

    }
}
