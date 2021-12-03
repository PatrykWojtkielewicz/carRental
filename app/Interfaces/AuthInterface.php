<?php

namespace App\Interfaces;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

interface AuthInterface
{
    /**
     * Register user.
     * 
     * @param  \Illuminate\Http\RegisterRequest  $request
     * @method POST api/register
     * @access public
     */
    public function register(RegisterRequest $request);

    /**
     * Login user
     * 
     * @param  \Illuminate\Http\LoginRequest  $request
     * @method POST api/login
     * @access public
     */
    public function login(LoginRequest $request);

    /**
     * Logout user
     * 
     * @method POST api/logout
     * @access public
     */
    public function logout();
}