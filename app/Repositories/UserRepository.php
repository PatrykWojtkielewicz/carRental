<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Interfaces\UserInterface;
use App\Traits\ResponseTrait;
use App\Models\User;

class UserRepository implements UserInterface
{
    use ResponseTrait;

    public function getUsers(){
        try{
            $users = User::all();
            return $this->success("All users", $users);
        }
        catch(\Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
    
    public function storeUser(UserRequest $request){
        try{
            $user = User::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'permission_id' => 2,
            ]);
            return $this->success("User stored", $user);
        }
        catch(\Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function showUser(User $user){
        try{
            if(!$user){
                return $this->error("No user with matching ID exists", 404);
            }

            return $this->success("User", $user);
        }
        catch(\Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function updateUser(UpdateUserRequest $request, User $user){
        try{
            if(!$user){
                return $this->error("No user with matching ID exists", 404);
            }

            $user->update($request->all());
            return $this->success("User updated", $user);
        }
        catch(\Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function destroyUser(User $user){
        try{
            if(!$user){
                return $this->error("No user with matching ID exists", 404);
            }

            $deleted = $user->delete();
            return $this->success("User deleted", $deleted);
        }
        catch(\Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function searchUser($name){
        try{
            $user = User::where('name', 'like', '%'.$name.'%')->get();
            return $this->success("User", $user);
        }
        catch(\Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}