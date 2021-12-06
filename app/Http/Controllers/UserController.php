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
        $data = $this->userInterface->getUsers();

        return response()->json([
            'message' => $data[0],
            'error' => $data[1],
            'results' => $data[2],
        ], $data[3]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $this->userInterface->storeUser($request);

        return response()->json([
            'message' => $data[0],
            'error' => $data[1],
            'results' => $data[2],
        ], $data[3]);
    }

    /**
     * Display the specified resource.
     *
     * @param App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $data = $this->userInterface->showUser($user);

        return response()->json([
            'message' => $data[0],
            'error' => $data[1],
            'results' => $data[2],
        ], $data[3]);
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
        $data = $this->userInterface->updateUser($request, $user);

        return response()->json([
            'message' => $data[0],
            'error' => $data[1],
            'results' => $data[2],
        ], $data[3]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $data = $this->userInterface->destroyUser($user);

        return response()->json([
            'message' => $data[0],
            'error' => $data[1],
            'results' => $data[2],
        ], $data[3]);
    }
}