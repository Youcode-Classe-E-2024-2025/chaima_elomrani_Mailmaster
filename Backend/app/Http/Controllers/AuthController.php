<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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


    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $user = $this->authService->login($request->all());

        if(!$user){
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return response()->json($user);
    }


    public function logout(Request $request)
    {
        $logedOut = $this->authService->logout();
       
        return response()->json([
           'message' => 'Logout successful'
        ]);
    }
}

