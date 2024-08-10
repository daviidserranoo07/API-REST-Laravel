<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\PostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use \stdClass;

class AuthController extends Controller
{
    public function register(PostRequest $request){

        $data = $request->validated();

        try{
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

    public function logout(){

        auth()->user()->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'You have been successfully logged out and the token has been deleted',
        ],200);
    }
}
