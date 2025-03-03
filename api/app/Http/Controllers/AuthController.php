<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //

    public function login(Request $request) {

        // $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);
     
        // $user = User::where('email', $request->email)->first();
     
        // if (! $user || ! Hash::check($request->password, $user->password)) {
        //     // throw ValidationException::withMessages([
        //     //     'email' => ['The provided credentials are incorrect.'],
        //     // ]);
        //     return response()->json([
        //         'message' => 'Invalid login details'
        //     ], 401);
        // }

        // $token = $user->createToken($request->email)->plainTextToken;
        
        // return response()->json([
        //     'token' => $token,
        //     'message' => 'Successfully logged in...',
        // ], 200);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }
        $request->session()->regenerate();

        return response()->json([
            'message' => 'Successfully logged in...',
        ], 200);

        
    }
}
