<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Interfaces\AuthInterface;
use App\Models\User;

class AuthRepository implements AuthInterface
{

    public function register(RegisterRequest $request){
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'permission_id' => 2,
        ]);
        $token = $user->createToken('myapptoken')->plainTextToken;

        return ["User registered", false, $user, $token, 200];
    }

    public function login(LoginRequest $request){
        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            return "Invalid login credentials";
        }
        $token = $user->createToken('myapptoken')->plainTextToken;

        return ["User logged in", false, $user, $token, 200];
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        return ["User logged out", false, 200];
    }
}