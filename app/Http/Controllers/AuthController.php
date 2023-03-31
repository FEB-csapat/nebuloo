<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use GuzzleHttp\Client;

use Illuminate\Support\Facades\Auth;

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

      //  dd($user);

        if ($user && Hash::check($credentials['password'], $user->password)) {
            $token = $user->createToken('token-name')->plainTextToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }





    public function redirectToProvider($provider)
    {
        $validated = $this->validateProvider($provider);
        if(!is_null($validated)){
            return $validated;
        }
        return Socialite::driver('google')->stateless()->redirect();
    }

    
    public function handleProviderCallback(Request $request, $provider)
    {
        $validated = $this->validateProvider($provider);
        if(!is_null($validated)){
            return $validated;
        }

        $code = $request->input('code');
        $clientId = 'YOUR_CLIENT_ID';
        $clientSecret = 'YOUR_CLIENT_SECRET';
        $redirectUri = 'YOUR_REDIRECT_URI';
        $grantType = 'authorization_code';
        $tokenUrl = 'https://oauth2.googleapis.com/token';

        $client = new Client();
        $response = $client->post($tokenUrl, [
            'form_params' => [
                'code' => $code,
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'redirect_uri' => $redirectUri,
                'grant_type' => $grantType,
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        $accessToken = $data['access_token'];
        $refreshToken = $data['refresh_token'];

        // Use the access token to get the user's information from the Google+ API.
        $userInfoUrl = 'https://www.googleapis.com/plus/v1/people/me';
        $response = $client->get($userInfoUrl, [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        $email = $data['emails'][0]['value'];
        $name = $data['displayName'];
        $avatar = $data['image']['url'];

        
        $userCreated = User::firstOrCreate(
            [
                'email' => $email
            ],
            [
                'email_verified_at' => now(),
                'name' => $name,
                'bio' => null
            ]
        );
        $userCreated->assignRole('user');
        $userCreated->provider()->updateOrCreate(
            [
                'provider' => $provider,
                'provider_id' => null,
            ],
            [
                'avatar' => $avatar
            ]
        );
        $token = $userCreated->createToken('token-name')->plainTextToken;
        
        /*
        return redirect('/questions')->with([
            'user' => new UserResource($userCreated),
            'token' => $token
        ]);
        */
        
        return response()->json(new UserResource($userCreated), 200, [
            'Access-Token' => $token,
            'Access-Control-Expose-Headers', 'Authorization',
            'Access-Control-Allow-Origin', '*'
        ]);
        
    }

    protected function validateProvider($provider){
        if(!in_array($provider, ['facebook', 'google'])){
            return response()->json(['error' => 'Please login using facebook or google'], 422);
        }
    }
}
