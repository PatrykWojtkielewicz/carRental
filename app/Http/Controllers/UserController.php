<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\UserRequest;
use App\Models\User;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status' => true,
            'users' => User::all(),
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return response()->json([
            'status' => true,
            'user' => $user,
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json([
            'status' => true,
            'user' => $user,
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());

        return response()->json([
            'status' => true,
            'updated' => $user,
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        return response()->json([
            'status' => true,
            'deleted' => $user->delete(),
        ], Response::HTTP_OK);
    }

    /**
     * Search for a name.
     *
     * @param  str $name
     * @return \Illuminate\Http\Response
     */
    public function search(User $name)
    {
        return response()->json([
            'status' => true,
            'users' => User::where('name', 'like', '%'.$name.'%')->get(),
        ], Response::HTTP_OK);
    }
}
