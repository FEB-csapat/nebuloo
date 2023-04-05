<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
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
        
        return response()->json(new UserResource($user), 200, [
            'Access-Token' => $token,
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            $token = $user->createToken('token-name')->plainTextToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
