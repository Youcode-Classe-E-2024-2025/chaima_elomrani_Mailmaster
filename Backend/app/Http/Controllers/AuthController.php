<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{

    protected $authService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct(AuthService $authService){

        $this->authService = $authService; 
    }


    public function register (Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $user = $this->authService->register($request->all());
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);

    }
}

