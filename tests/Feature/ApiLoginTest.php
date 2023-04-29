<?php

namespace Tests\Feature;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiLoginTest extends TestCase
{
    use DatabaseTransactions;
    private $data;
    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        Role::findOrCreate('admin');
        Role::findOrCreate('moderator');
        Role::findOrCreate('user');

        $this->user = User::factory()->create([
            'password' => Hash::make('Test123@')
            
        ]);

        $this->data = [
            'identifier' => $this->user->name,
            'password' => 'Test123@'
        ];
    }

    public function test_login_with_username()
    {
        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/login", $this->data);

        $response->assertOk()
        ->assertJsonStructure([
            'token',
            'user'
        ])->assertJson([
            'user' => [
                'id' => $this->user->id,
            ]
        ]);
    }

    public function test_login_with_email()
    {
        $this->data = array_merge($this->data, [
            'identifier' => $this->user->email
        ]);

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/login", $this->data);

        $response->assertOk()
        ->assertJsonStructure([
            'token',
            'user'
        ])->assertJson([
            'user' => [
                'id' => $this->user->id,
            ]
        ]);
    }

    public function test_login_with_non_existing_username()
    {
        $this->data = array_merge($this->data, [
            'identifier' => 'fakeusername12'
        ]);

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/login", $this->data);

        $response
        ->assertStatus(404)
        ->assertJson([
            'message' => 'Nem található felhasználó ilyen névvel, vagy e-maillel!',
        ]);
    }

    public function test_login_with_non_existing_email()
    {
        $this->data = array_merge($this->data, [
            'identifier' => 'fakeuser12@zetamail.zed'
        ]);

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/login", $this->data);

        $response
        ->assertStatus(404)
        ->assertJson([
            'message' => 'Nem található felhasználó ilyen névvel, vagy e-maillel!',
    ]);
    }

    public function test_login_with_wrong_password()
    {
        $this->data = array_merge($this->data, [
            'password' => 'fakepassword123#'
        ]);

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/login", $this->data);

        $response
        ->assertStatus(401)
        ->assertJson([
            'message' => 'Hibás jelszó!',
    ]);
    }

    public function test_login_with_wrong_password_and_non_existing_username()
    {
        $this->data = array_merge($this->data, [
            'identifier'=>'fakeusername88',
            'password' => 'fakepassword123#'
        ]);

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/login", $this->data);

        $response
        ->assertStatus(404)
        ->assertJson([
            'message' => 'Nem található felhasználó ilyen névvel, vagy e-maillel!',
        ]);
    }

    public function test_login_with_wrong_password_and_non_existing_email()
    {
        $this->data = array_merge($this->data, [
            'identifier'=>'fakeuser12@zetamail.zed',
            'password' => 'fakepassword123#'
        ]);

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/login", $this->data);

        $response
        ->assertStatus(404)
        ->assertJson([
            'message' => 'Nem található felhasználó ilyen névvel, vagy e-maillel!',
        ]);
    }

    public function test_login_without_identifier()
    {
        $this->data = array_merge($this->data, [
            'identifier'=>null
        ]);

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/login", $this->data);

        $response
        ->assertStatus(422)
        ->assertJson([
            'message' => 'A(z) azonosító mező kitöltése kötelező.',
            'errors' => [
                'identifier' => ['A(z) azonosító mező kitöltése kötelező.']
            ]
        ]);
    }

    public function test_login_without_password()
    {
        $this->data = array_merge($this->data, [
            'password'=>null
        ]);

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/login", $this->data);

        $response
        ->assertStatus(422)
        ->assertJson([
            'message' => 'A(z) jelszó mező kitöltése kötelező.',
            'errors' => [
                'password' => ['A(z) jelszó mező kitöltése kötelező.']
            ]
        ]);
    }

    public function test_login_without_password_and_identifier()
    {
        $this->data = array_merge($this->data, [
            'password'=>null,
            'identifier'=>null
        ]);

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/login", $this->data);

        $response
        ->assertStatus(422)
        ->assertJson([
            'message' => 'A(z) azonosító mező kitöltése kötelező. (and 1 more error)',
            'errors' => [
                'password' => ['A(z) jelszó mező kitöltése kötelező.'],
                'identifier' => ['A(z) azonosító mező kitöltése kötelező.']
            ]
        ]);
    }

    public function test_login_as_banned_user()
    {
        $this->user->banned = true;
        $this->user->save();

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/login", $this->data);

        $response
        ->assertStatus(403)
        ->assertJson([
            'message' => 'A felhasználó ki van tiltva!',
        ]);
    }

}