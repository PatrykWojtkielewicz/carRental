<?php

namespace App\Interfaces;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

interface UserInterface{
    /**
     * Get all users
     * 
     * @method GET api/users
     * @access public
     */
    public function getUsers();

    /**
     * Store new user
     * 
     * @param \App\Http\Requests\UserRequest $request
     * @method POST api/users
     * @access public
     */
    public function storeUser(UserRequest $request);

    /**
     * Show specified user
     * 
     * @param \App\Models\User $user
     * @method GET api/users/{$user}
     * @access public
     */
    public function showUser(User $user);

    /**
     * Update specified user
     * 
     * @param \App\Http\Requests\UpdateUserRequest $request
     * @param App\Models\User $user
     * @method PUT api/users/{user}
     * @access public
     */
    public function updateUser(UpdateUserRequest $request, User $user);

    /**
     * Destroy specified user
     * 
     * @param \App\Models\User $user
     * @method DELETE api/users/{user}
     * @access public
     */
    public function destroyUser(User $user);

    /**
     * Search for specified user
     * 
     * @param  str $name
     * @method GET api/users/search/{name}
     * @access public
     */
    public function searchUser($name);
}