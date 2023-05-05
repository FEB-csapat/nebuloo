<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiRegisterTest extends TestCase
{
    use DatabaseTransactions;

    private $data;

    protected function setUp(): void
    {
        parent::setUp();

        $this->data = [
            'username' => 'TestUser',
            'email' => 'Testing@test.test',
            'password' => 'Test123@',
            'password_confirmation' => 'Test123@'
        ];
    }

    private $user;
    public function test_create_a_user()
    {
        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/register", $this->data);
        $response->assertCreated();
            $this->assertDatabaseHas('users', [
                'username' => 'TestUser',
                'email' => 'Testing@test.test'
            ]);
    }

    public function test_create_a_user_with_mismatched_password()
    {
        $this->data = array_merge($this->data, [
            'password_confirmation' => 'Test12@'
        ]);

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/register", $this->data);

        $response
        ->assertUnprocessable()
        ->assertJson([
            'message' => 'jelszó megerősítése nem egyezik meg.',
            'errors' => [
                'password' => ['jelszó megerősítése nem egyezik meg.']
            ]
    ]);
    }

    public function test_create_a_user_with_password_without_special()
    {
        $this->data = array_merge($this->data, [
            'password' => 'Test12345',
            'password_confirmation' => 'Test12345'
        ]);
    
        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/register", $this->data);
    
        $response
            ->assertUnprocessable()
            ->assertJson([
                'message' => 'A(z) jelszó formátuma érvénytelen.',
                'errors' => [
                    'password' => ['A(z) jelszó formátuma érvénytelen.']
                ]
        ]);
    }

    public function test_create_a_user_with_short_password()
    {
        $this->data = array_merge($this->data, [
            'password' => 'Te',
            'password_confirmation' => 'Te'
        ]);

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/register", $this->data);

        $response
        ->assertUnprocessable()
        ->assertJson([
            'message' => 'A(z) jelszó hossza legalább 8 karakter kell legyen. (and 1 more error)',
            'errors' => [
                'password' => 
                [
                    'A(z) jelszó hossza legalább 8 karakter kell legyen.',
                    'A(z) jelszó formátuma érvénytelen.'
                ]
            ]
    ]);
    }
    public function test_create_a_user_with_password_without_uppercase()
    {
        $this->data = array_merge($this->data, [
            'password' => 'testing123@',
            'password_confirmation' => 'testing123@'
        ]);

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/register", $this->data);

        $response
        ->assertUnprocessable()
        ->assertJson([
            'message' => 'A(z) jelszó formátuma érvénytelen.',
            'errors' => [
                'password' => 
                [
                    'A(z) jelszó formátuma érvénytelen.'
                ]
            ]
        ]);
    }

    public function test_create_a_user_with_password_without_numeric()
    {
        $this->data = array_merge($this->data, [
            'password' => 'testingtest@',
            'password_confirmation' => 'testingtest@'
        ]);

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/register", $this->data);

        $response
        ->assertUnprocessable()
        ->assertJson([
            'message' => 'A(z) jelszó formátuma érvénytelen.',
            'errors' => [
                'password' => 
                [
                    'A(z) jelszó formátuma érvénytelen.'
                ]
            ]
    ]);
    }
    public function test_create_a_user_with_password_without_lowercase()
    {
        $this->data = array_merge($this->data, [
            'password' => 'TESTINGTEST12@',
            'password_confirmation' => 'TESTINGTEST12@'
        ]);

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/register", $this->data);

        $response
        ->assertUnprocessable()
        ->assertJson([
            'message' => 'A(z) jelszó formátuma érvénytelen.',
            'errors' => [
                'password' => 
                [
                    'A(z) jelszó formátuma érvénytelen.'
                ]
            ]
        ]);
    }
    public function test_create_a_user_without_filling_password_confirmation()
    {
        $this->data = array_merge($this->data, [
            'password_confirmation' => null
        ]);

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/register", $this->data);

        $response
        ->assertUnprocessable()
        ->assertJson([
            'message' => 'jelszó megerősítése nem egyezik meg.',
            'errors' => [
                'password' => 
                [
                    'jelszó megerősítése nem egyezik meg.'
                ]
            ]
    ]);
    }
    public function test_create_a_user_without_email()
    {
        $this->data = array_merge($this->data, [
            'email' => null
        ]);

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/register", $this->data);

        $response
        ->assertUnprocessable()
        ->assertJson([
            'message' => 'A(z) e-mail cím mező kitöltése kötelező.',
            'errors' => [
                'email' => 
                [
                    'A(z) e-mail cím mező kitöltése kötelező.'
                ]
            ]
    ]);
    }
    public function test_create_a_user_without_username()
    {
        $this->data = array_merge($this->data, [
            'username' => null
        ]);

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/register", $this->data);

        $response
        ->assertUnprocessable()
        ->assertJson([
            'message' => 'A(z) felhasználónév mező kitöltése kötelező.',
            'errors' => [
                'username' => 
                [
                    'A(z) felhasználónév mező kitöltése kötelező.'
                ]
            ]
    ]);
    }
    public function test_create_a_user_with_invalid_email()
    {
        $this->data = array_merge($this->data, [
            'email' => 'Testingtesttest',
        ]);

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/register", $this->data);

        $response
        ->assertUnprocessable()
        ->assertJson([
            'message' => 'e-mail cím érvényes email cím kell legyen.',
            'errors' => [
                'email' => 
                [
                    'e-mail cím érvényes email cím kell legyen.'
                ]
            ]
    ]);
    }
    public function test_create_a_user_with_short_username()
    {
        $this->data = array_merge($this->data, [
            'username' => 'Te',
        ]);

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/register", $this->data);

        $response
        ->assertUnprocessable()
        ->assertJson([
            'message' => 'A(z) felhasználónév hossza legalább 4 karakter kell legyen.',
            'errors' => [
                'username' => 
                [
                    'A(z) felhasználónév hossza legalább 4 karakter kell legyen.'
                ]
            ]
    ]);
    }
    public function test_create_a_user_with_long_username()
    {
        $this->data = array_merge($this->data, [
            'username' => 'TestTestTestTestTestTestTest',
        ]);

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/register", $this->data);

        $response
        ->assertUnprocessable()
        ->assertJson([
            'message' => 'A(z) felhasználónév hossza nem lehet nagyobb, mint 25 karakter.',
            'errors' => [
                'username' => 
                [
                    'A(z) felhasználónév hossza nem lehet nagyobb, mint 25 karakter.'
                ]
            ]
    ]);
    }
    public function test_create_a_user_without_password()
    {
        $this->data = array_merge($this->data, [
            'password' => null,
        ]);

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/register", $this->data);

        $response
        ->assertUnprocessable()
        ->assertJson([
            'message' => 'A(z) jelszó mező kitöltése kötelező.',
            'errors' => [
                'password' => 
                [
                    'A(z) jelszó mező kitöltése kötelező.'
                ]
            ]
        ]);
    }
    public function test_create_a_user_that_already_exists_with_username()
    {
        $otherUser = User::factory()->create([
            'username'=>'otherUserName'
        ]);
        $this->data = array_merge($this->data, [
            'username' => $otherUser->username,
        ]);
        
        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/register", $this->data);

        $response
        ->assertUnprocessable()
        ->assertJson([
            'message' => 'A(z) felhasználónév már foglalt.',
            'errors' => [
                'username'=> [
                    'A(z) felhasználónév már foglalt.'
                ]
            ]
        ]);
    }

    public function test_create_a_user_that_already_exists_with_email()
    {
        $otherUser = User::factory()->create([
            'email'=>'other.user@fakemail.com'
        ]);
        $this->data = array_merge($this->data, [
            'email' => $otherUser->email,
        ]);
        
        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/register", $this->data);

        $response
        ->assertUnprocessable()
        ->assertJson([
            'message' => 'A(z) e-mail cím már foglalt.',
            'errors' => [
                'email'=> [
                    'A(z) e-mail cím már foglalt.'
                ]
            ]
        ]);
    }

    public function test_create_a_user_with_special_character_in_username()
    {
        $this->data = array_merge($this->data, [
            'username' => 'Test@',
        ]);

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/register", $this->data);

        $response
        ->assertUnprocessable()
        ->assertJson([
            'message' => 'felhasználónév csak betűket és számokat tartalmazhat.',
            'errors' => [
                'username'=> [
                    'felhasználónév csak betűket és számokat tartalmazhat.'
                ]
            ]
        ]);
    }

}