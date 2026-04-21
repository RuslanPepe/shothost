<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller{
    public function getUser(Request $request) {
        logger($request);
        return $request->user();
    }
    public function login(Request $request) {
//        logger($request);

//        $request->validate([
//            'user.email' => ['required', 'email'],
//            'user.password' => ['required'],
//        ]);

        $credentials = [
            'email' => $request->user['email'],
            'password' => $request->user['password'],
        ];
//        logger($credentials['email']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        return response()->json([
            'user' => $user,
        ]);

    }
    public function register(Request $request) {

        $request->validate([
            'user' => [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed'],
            ]
        ]);

        $user = User::create([
            'name' => $request->user['name'],
            'email' => $request->user['email'],
            'password' => Hash::make($request->user['password']),
        ]);

//        event(new Registered($user));

        Auth::login($user);

        return response()->json([
            'user' => $user,
            'access_token' => $user->createToken('api-token')->plainTextToken
        ], 201);
    }
    public function logout(Request $request) {

    }
}
