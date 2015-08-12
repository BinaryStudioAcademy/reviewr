<?php

namespace App\Repositories;

use App;
use App\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function all()
    {
        return User::all();
    }

    public function OneById($id)
    {
    	return User::with('job', 'department')->find($id);
    }

    public function create($data) {}

    public function delete($id)
    {
        return User::findOrFail($id)->delete();
    }
}