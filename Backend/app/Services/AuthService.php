<?php

namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService{

    public function register(array $data):User{
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}