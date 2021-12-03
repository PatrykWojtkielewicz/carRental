<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Interfaces\UserInterface;
use App\Models\User;

class UserController extends Controller
{
    protected $userInterface;

    /**
     * Create a new constructor for this controller
     */
    public function __construct(UserInterface $userInterface){
        $this->userInterface = $userInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return $this->userInterface->getUsers();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        return $this->userInterface->storeUser($request);
    }

    /**
     * Display the specified resource.
     *
     * @param App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $this->userInterface->showUser($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateUserRequest $request
     * @param App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        return $this->userInterface->updateUser($request, $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        return $this->userInterface->destroyUser($user);
    }

    /**
     * Search for a name.
     *
     * @param  str $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        return $this->userInterface->searchUser($name);
    }
}