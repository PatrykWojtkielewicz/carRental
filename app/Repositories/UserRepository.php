<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Interfaces\UserInterface;
use App\Models\User;

class UserRepository implements UserInterface
{
    public function getUsers(){
        $users = User::all();
        return ["All users", false, $users, 200];
    }
    
    public function storeUser(UserRequest $request){
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'permission_id' => 2,
        ]);
        return ["User stored", false, $user, 200];
    }

    public function showUser(User $user){
        return ["User", false, $user, 200];
    }

    public function updateUser(UpdateUserRequest $request, User $user){
        $user->update($request->all());
        return ["User updated", false, $user, 200];
    }

    public function destroyUser(User $user){
        $deleted = $user->delete();
        return ["User deleted", false, $user, 200];
    }
}