<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    public function register(StoreUserRequest $request)
    {
        $request->validated();
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        $token = $user->createToken('token-name')->plainTextToken;
        
        return response()->json([
            'message' => 'Successfully created user!',
        ], 201);
    }

    public function login(LoginUserRequest $request)
    {
        $data = $request->validated();

        $user = null;
        if($data['email'] ?? null){
            $user = User::where('email', $data['email'])->first();
        } else {
            $user = User::where('name', $data['name'])->first();
        }

        if(!$user){
            return response()->json(['error' => 'No user found with such email or username!'], 404);
        }

        if (Hash::check($data['password'], $user->password)) {
            $token = $user->createToken('token-name')->plainTextToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Wrong password!'], 401);
        }
    }
}
