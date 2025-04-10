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

    /**
     * Register a new user.
     *
     * @OA\Post(
     *     path="/api/auth/register",
     *     summary="Register a new user",
     *     description="Creates a new user account and returns authentication token",
     *     operationId="register",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="User registration data",
     *         @OA\JsonContent(
     *             required={"name", "email", "password", "password_confirmation"},
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", format="email", example="john@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="strongpassword"),
     *             @OA\Property(property="password_confirmation", type="string", format="password", example="strongpassword")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User registered successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="user",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="John Doe"),
     *                 @OA\Property(property="email", type="string", example="john@example.com"),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             ),
     *             @OA\Property(property="token", type="string", example="1|laravel_sanctum_token_hash")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="email", type="array", @OA\Items(type="string", example="The email has already been taken.")),
     *             @OA\Property(property="password", type="array", @OA\Items(type="string", example="The password confirmation does not match."))
     *         )
     *     )
     * )
     */

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

     /**
     * Login user and create token.
     *
     * @OA\Post(
     *     path="/api/auth/login",
     *     summary="User login",
     *     description="Authenticates a user and returns token",
     *     operationId="login",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="User login credentials",
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", format="email", example="john@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="strongpassword")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login successful",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="user", type="object"),
     *             @OA\Property(property="token", type="string", example="1|laravel_sanctum_token_hash")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid credentials",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Invalid credentials")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="email", type="array", @OA\Items(type="string", example="The email field is required.")),
     *             @OA\Property(property="password", type="array", @OA\Items(type="string", example="The password field is required."))
     *         )
     *     )
     * )
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

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

    
    /**
     * Logout user (Revoke the token).
     *
     * @OA\Post(
     *     path="/api/auth/logout",
     *     summary="Logout user",
     *     description="Revokes the user's authentication token",
     *     operationId="logout",
     *     tags={"Authentication"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Logout successful",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Logout successful")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     )
     * )
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function logout(Request $request)
    {
        $logedOut = $this->authService->logout();
       
        return response()->json([
           'message' => 'Logout successful'
        ]);
    }
}

