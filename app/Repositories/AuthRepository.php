<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Interfaces\AuthInterface;
use App\Traits\ResponseTrait;
use App\Models\User;

class AuthRepository implements AuthInterface
{
    use ResponseTrait;

    public function register(RegisterRequest $request){
        try {
            $user = User::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'permission_id' => 2,
            ]);
            $token = $user->createToken('myapptoken')->plainTextToken;

            return $this->success("User registered", [$user, $token]);
        }
        catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function login(LoginRequest $request){
        try {
            $user = User::where('email', $request->email)->first();
            if(!$user || !Hash::check($request->password, $user->password)){
                return $this->error("Invalid login credentials", 401);
            }
            $token = $user->createToken('myapptoken')->plainTextToken;

            return $this->success("User logged in", [$user, $token]);
        }
        catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function logout(){
        try {
            auth()->user()->tokens()->delete();
            return $this->success("User logged out", null);
        }
        catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}