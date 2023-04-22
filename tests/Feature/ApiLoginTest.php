<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Content;
use App\Models\Question;
use App\Models\User;
use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiLoginTest extends TestCase
{
    use DatabaseTransactions;
    private $data;
    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user =[
            'name' => 'TestingUser',
            'email' => 'Testing@tester.test',
            'password' => 'Test123@',
            'password_confirmation' => 'Test123@'
        ];
        $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/register", $this->user);
        $this->data = [
            'identifier' => 'TestingUser',
            'password' => 'Test123@'
        ];
    }

    public function test_login_with_username()
    {
        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/login", $this->data);

        $response->assertOk();
    }

    public function test_login_with_email()
    {
        $this->data = array_merge($this->data, [
            'identifier' => 'Testing@tester.test'
        ]);

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/login", $this->data);

        $response->assertOk();
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
            'message' => 'Nem található ilyen felhasználónév vagy email-cím!',
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
            'message' => 'Nem található ilyen felhasználónév vagy email-cím!',
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
            'message' => 'Hibás a jelszó!',
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
            'message' => 'Nem található ilyen felhasználónév vagy email-cím!',
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
            'message' => 'Nem található ilyen felhasználónév vagy email-cím!',
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
            'message' => 'The identifier field is required.',
            'errors' => [
                'identifier' => ['The identifier field is required.']
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
            'message' => 'The password field is required.',
            'errors' => [
                'password' => ['The password field is required.']
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
            'message' => 'The identifier field is required. (and 1 more error)',
            'errors' => [
                'password' => ['The password field is required.'],
                'identifier' => ['The identifier field is required.']
            ]
    ]);
    }
}