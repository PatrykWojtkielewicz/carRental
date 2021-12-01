<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'permission_id' => '2',
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;
        return response()->json([
            'user'=> $user,
            'token'=> $token,
        ], 201);
    }

    public function login(LoginRequest $request){
        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            return response([
                'message' => 'Nie poprawne dane logowania'
            ], 401);
        }
        $token = $user->createToken('myapptoken')->plainTextToken;
        return response()->json([
            'user'=> $user,
            'token'=> $token,
        ], 201);
    }

    public function logout(){
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Wylogowano'
        ]);
    }
}
