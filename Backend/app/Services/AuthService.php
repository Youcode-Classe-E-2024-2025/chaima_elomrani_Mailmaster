<?php

namespace App\Services;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth;

class AuthService{

    public function register(array $data):User{
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function login(array $id){
        
        $user = User::where('email', $id['email'])->first();
        if(!$user || Hash::check($id['password'], $user->password)){
            return false; 
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        
        return [
           'user' => $user,
           'token' => $token   
        ]

    }
}