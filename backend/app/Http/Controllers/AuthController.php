<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class AuthController extends Controller
{

    public function redirectToProvider($provider)
    {
        $validated = $this->validateProvider($provider);
        if(!is_null($validated)){
            return $validated;
        }
        return Socialite::driver('google')->stateless()->redirect();
    }

    
    public function handleProviderCallback($provider)
    {
        $validated = $this->validateProvider($provider);
        if(!is_null($validated)){
            return $validated;
        }

        try {
            $socialUser = Socialite::driver($provider)->stateless()->user();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid credentials provided.'], 422);
        }
        
        
        
        $userCreated = User::firstOrCreate(
            [
                'email' => $socialUser->getEmail()
            ],
            [
                'email_verified_at' => now(),
                'name' => $socialUser->getName(),
                'bio' => null
            ]
        );
        $userCreated->providers()->updateOrCreate(
            [
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
            ],
            [
                'avatar' => $socialUser->getAvatar()
            ]
        );
        $token = $userCreated->createToken('token-name')->plainTextToken;

        
        return response()->json(new UserResource($userCreated), 200, ['Access-Token' => $token]);
        
        
        
        
        
        
        /*
        
        $existingUser = User::where('email', $user->email)->first();
        
        if($existingUser){
            
            $token = $existingUser->createToken('access_token')->accessToken;

        } else {
            // create a new user
            $newUser = User::firstOrCreate(
                ['email' => ],
                []
            );
            $newUser->save();
            
            $token = $newUser->createToken('access_token')->accessToken;

            return $token;
        }
        */
    }

    protected function validateProvider($provider){
        if(!in_array($provider, ['facebook', 'google'])){
            return response()->json(['error' => 'Please login using facebook or google'], 422);
        }
    }
}
