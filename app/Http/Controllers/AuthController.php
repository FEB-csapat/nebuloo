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
            'name' => $request->name,
            'display_name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('user');
        
        return response()->json([
            'message' => 'Successfully created user!',
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
            $user = User::where('name', $data['identifier'])->first();
        }

        if(!$user){
            abort(404, 'No user found with such username or email!');
        }

        if($user->banned){
            abort(403, 'Banned user is not permitted to log in!');
            
        }

        if (Hash::check($data['password'], $user->password)) {
            $token = $user->createToken('token-name')->plainTextToken;
            return response()->json([
                'token' => $token,
                'user' => new UserResource($user),
            ], 200);
        } else {
            abort(401, 'Wrong password!');
        }
    }
}
