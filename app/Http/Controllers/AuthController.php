<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Store a newly registered user in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(StoreUserRequest $request)
    {
        $request->validated();
    
        $user = User::create([
            'username' => $request->username,
            'display_name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        return response()->json([
            'message' => __('messages.successful_registration'),
        ], 201);
    }

    /**
     * Log in a user.
     *
     * @param  \App\Http\Requests\LoginUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginUserRequest $request)
    {
        $data = $request->validated();

        $user = null;
        if(strpos($data['identifier'], '@') ){
            $user = User::where('email', $data['identifier'])->first();
        } else {
            $user = User::where('username', $data['identifier'])->first();
        }

        if(!$user){
            abort(404, __('messages.identifier_not_found'));
        }

        if($user->banned){
            abort(403, __('messages.user_banned'));
            
        }

        if (Hash::check($data['password'], $user->password)) {
            $token = $user->createToken('token-name')->plainTextToken;
            return response()->json([
                'token' => $token,
                'user' => new UserResource($user),
            ], 200);
        } else {
            abort(401, __('messages.wrong_password'));
        }
    }
}
