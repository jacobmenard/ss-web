<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

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
    public function update(Request $request, User $user)
    {
        //
        $user->age = $request->age;
        $user->height = $request->height;
        $user->cell_phone = $request->cell_phone;
        $user->interests = $request->interest;
        $user->general_bio = $request->generalBio;
        $user->facts = $request->funFact;
        $user->save();

        return success(new UserResource($user), 'User Information successfully updated!');
        
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
                                    ->orWhere('last_name', 'like', '%' . $request->search . '%')
                                    ->orWhere(DB::raw("concat(first_name, ' ', last_name)"), $request->search);
                                    
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
            // $path = Storage::disk('local')->put('attendees', $request->profile_image);
            $path = Storage::disk('s3')->put('attendees', $request->profile_image, 'public');
            
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

    public function forgotPassword(Request $request) {

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == 'passwords.sent') {
            return success($status, 'Reset password link successfully sent to your email!');
        } else {
            return success($status, 'Error on requesting reset password, please try different email', 'error');
        }
    }

    public function publicChangeUserPassword(Request $request, User $users) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    // 'password' => Hash::make($password)
                    'password' => bcrypt($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));

                
                // $user->password = bcrypt($password);
                // $user->remember_token = Str::random(60);
                // $user->is_changed_password = 2;
                // $user->save();
            }

        );

        if ($status == 'passwords.reset') {
            return success($status, 'Password successfully reset!');
        } else if ($status == 'passwords.token') {
            return success($status, 'Reset password token has already expired, Please try to request again', 'error');
        } else {
            return success($status, 'Error resetting password, please try again', 'error');
        }
        // return $status;
    }
    
}
