<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\PostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use \stdClass;

class AuthController extends Controller
{
    /**
     * Register a new user
     */
    public function register(PostRequest $request){


        try{
            $data = $request->validated();
    
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
    
            $token = $user->createToken('auth_token')->plainTextToken;
    
            return response()->json([
                'status' => true,
                'data' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ],201);
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'Failed to register',
            ],500);
        }
        
    }

    /**
     * Login user
     */
    public function login(Request $request){

        if(!Auth::attempt($request->only('email','password'))){
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
            ],401);
        }

        $user = User::where('email',$request->email)->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Hi, '.$user->name,
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ],200);
    }

    /**
     * Logout user
     */
    public function logout(){

        auth()->user()->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'You have been successfully logged out and the token has been deleted',
        ],200);
    }
}
