<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class AuthController extends Controller
{

    
    public function redirectToProvider()
    {
        return Socialite::driver('google')->stateless()->user();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
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
    


/*
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }        // only allow people with @company.com to login
        
        $existingUser = User::where('email', $user->email)->first();        if($existingUser){
            // log them in
            auth()->login($existingUser, true);
        } else {
            // create a new user
            $newUser                  = new User;
            $newUser->name            = $user->name;
            $newUser->email           = $user->email;
            $newUser->google_id       = $user->id;
            $newUser->avatar          = $user->avatar;
            $newUser->avatar_original = $user->avatar_original;
            $newUser->save();            auth()->login($newUser, true);
        }
        return redirect()->to('/home');
    }
*/
}
