<?php

namespace App\Services\v1;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function handleRegister($data)
    {
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }
}
