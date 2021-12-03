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
        return $this->authInterface->register($request);
    }

    /**
     * Login user
     * 
     * @param \App\Http\Requests\LoginRequest $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request){
        return $this->authInterface->login($request);
    }

    /**
     * Logout user
     * 
     * @return \Illuminate\Http\Response
     */
    public function logout(){
        return $this->authInterface->logout();
    }
}
