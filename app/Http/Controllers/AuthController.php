<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Interfaces\AuthInterface;

class AuthController extends Controller
{
    protected $authInterface;

    /**
     * Create a new constructor for this controller
     */
    public function __construct(AuthInterface $authInterface){
        $this->authInterface = $authInterface;
    }

    /**
     * Register user
     * 
     * @param \App\Http\Requests\RegisterRequest $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request){
        $data = $this->authInterface->register($request);

        return response()->json([
            'message' => $data[0],
            'error' => $data[1],
            'user' => $data[2],
            'token' => $data[3],
        ], $data[4]);
    }

    /**
     * Login user
     * 
     * @param \App\Http\Requests\LoginRequest $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request){
        $data = $this->authInterface->login($request);

        return response()->json([
            'message' => $data[0],
            'error' => $data[1],
            'user' => $data[2],
            'token' => $data[3],
        ], $data[4]);
    }

    /**
     * Logout user
     * 
     * @return \Illuminate\Http\Response
     */
    public function logout(){
        $data = $this->authInterface->logout();

        return response()->json([
            'message' => $data[0],
            'error' => $data[1],
        ], $data[2]);
    }
}
