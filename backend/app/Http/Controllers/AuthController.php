<?php

namespace App\Http\Controllers;

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
            $user = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return $e;
          //  return redirect('/login');
        }
        
        $existingUser = User::where('email', $user->email)->first();
        
        if($existingUser){
            
            $token = $existingUser->createToken('access_token')->accessToken;

        } else {
            // create a new user
            $newUser = User::fromGoogle($user);
            $newUser->save();
            
            $token = $newUser->createToken('access_token')->accessToken;

            return $token;
        }
    }

    protected function validateProvider($provider){
        if(!in_array($provider, ['facebook', 'google'])){
            return response()->json(['error' => 'Please login using facebook or google'], 422);
        }
    }
}
