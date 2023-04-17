<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(StoreUserRequest $request)
    {
        $request->validated();
    
        $user = User::create([
            'name' => $request->name,
            'display_name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        return response()->json([
            'message' => 'Successfully created user!',
        ], 201);
    }

    public function login(LoginUserRequest $request)
    {
        $data = $request->validated();

        $user = null;
        if(strpos($data['identifier'], '@') ){
            $user = User::where('email', $data['identifier'])->first();
        } else {
            $user = User::where('name', $data['identifier'])->first();
        }

        if(!$user){
            return response()->json(['message' => 'Nem található ilyen felhasználónév vagy email-cím!'], 404);
        }

        if (Hash::check($data['password'], $user->password)) {
            $token = $user->createToken('token-name')->plainTextToken;
            return response()->json([
                'token' => $token,
                'user' => new UserResource($user),
            ], 200);
        } else {
            return response()->json(['message' => 'Hibás a jelszó!'], 401);
        }
    }
}
