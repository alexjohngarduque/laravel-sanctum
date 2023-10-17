<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginUserRequest $request)
    {
        $request->validated($request->all());

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return $this->error('', 'Credentials do not match', 401);
        }

        $user = User::where('email', $request->email)->first();
        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token of ' . $user->name)->plainTextToken //CREATES A TOKEN ONCE LOGGED IN
        ],'Logged-in Successfully.');
        //return ('This is my login method');
    }

    public function register(StoreUserRequest $request)
    {
        $request->validated($request->all());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        //return response()->json('This is my register method');
        return $this->success([
            'user' => $user,
            //'token' => $user->createToken('API Token of ' . $user->name)->plainTextToken (NOT NEEDED - SINCE YOU HAVEN'T LOGGED IN YET)
        ],'User Registered Successfully.');
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return $this->success('Logged out successfully - Your token has been deleted.');
        //return response()->json('This is my register method');
    }

}