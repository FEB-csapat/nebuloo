<?php

namespace Tests\Feature;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiRegisterTest extends TestCase
{
    use DatabaseTransactions;

    private $data;

    protected function setUp(): void
    {
        parent::setUp();

        Role::findOrCreate('admin');
        Role::findOrCreate('moderator');
        Role::findOrCreate('user');

        $this->data = [
            'name' => 'TestUser',
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
                'name' => 'TestUser',
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
        ->assertStatus(422)
        ->assertJson([
            'message' => 'The password confirmation does not match.',
            'errors' => [
                'password' => ['The password confirmation does not match.']
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
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The password format is invalid.',
                'errors' => [
                    'password' => ['The password format is invalid.']
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
        ->assertStatus(422)
        ->assertJson([
            'message' => 'The password must be at least 8 characters. (and 1 more error)',
            'errors' => [
                'password' => 
                [
                    'The password must be at least 8 characters.',
                    'The password format is invalid.'
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
        ->assertStatus(422)
        ->assertJson([
            'message' => 'The password format is invalid.',
            'errors' => [
                'password' => 
                [
                    'The password format is invalid.'
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
        ->assertStatus(422)
        ->assertJson([
            'message' => 'The password format is invalid.',
            'errors' => [
                'password' => 
                [
                    'The password format is invalid.'
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
        ->assertStatus(422)
        ->assertJson([
            'message' => 'The password format is invalid.',
            'errors' => [
                'password' => 
                [
                    'The password format is invalid.'
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
        ->assertStatus(422)
        ->assertJson([
            'message' => 'The password confirmation does not match.',
            'errors' => [
                'password' => 
                [
                    'The password confirmation does not match.'
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
        ->assertStatus(422)
        ->assertJson([
            'message' => 'The email field is required.',
            'errors' => [
                'email' => 
                [
                    'The email field is required.'
                ]
            ]
    ]);
    }
    public function test_create_a_user_without_name()
    {
        $this->data = array_merge($this->data, [
            'name' => null
        ]);

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/register", $this->data);

        $response
        ->assertStatus(422)
        ->assertJson([
            'message' => 'The name field is required.',
            'errors' => [
                'name' => 
                [
                    'The name field is required.'
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
        ->assertStatus(422)
        ->assertJson([
            'message' => 'The email must be a valid email address.',
            'errors' => [
                'email' => 
                [
                    'The email must be a valid email address.'
                ]
            ]
    ]);
    }
    public function test_create_a_user_with_short_name()
    {
        $this->data = array_merge($this->data, [
            'name' => 'Te',
        ]);

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/register", $this->data);

        $response
        ->assertStatus(422)
        ->assertJson([
            'message' => 'The name must be at least 4 characters.',
            'errors' => [
                'name' => 
                [
                    'The name must be at least 4 characters.'
                ]
            ]
    ]);
    }
    public function test_create_a_user_with_long_name()
    {
        $this->data = array_merge($this->data, [
            'name' => 'TestTestTestTestTestTestTest',
        ]);

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/register", $this->data);

        $response
        ->assertStatus(422)
        ->assertJson([
            'message' => 'The name must not be greater than 25 characters.',
            'errors' => [
                'name' => 
                [
                    'The name must not be greater than 25 characters.'
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
        ->assertStatus(422)
        ->assertJson([
            'message' => 'The password field is required.',
            'errors' => [
                'password' => 
                [
                    'The password field is required.'
                ]
            ]
    ]);
    }
    public function test_create_a_user_that_already_exists_with_name()
    {
        $otherUser = User::factory()->create([
            'name'=>'otherUserName'
        ]);
        $this->data = array_merge($this->data, [
            'name' => $otherUser->name,
        ]);
        
        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/register", $this->data);

        $response
        ->assertStatus(422)
        ->assertJson([
            'message' => 'The name has already been taken.',
            'errors' => [
                'name'=> [
                    'The name has already been taken.'
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
        ->assertStatus(422)
        ->assertJson([
            'message' => 'The email has already been taken.',
            'errors' => [
                'email'=> [
                    'The email has already been taken.'
                ]
            ]
        ]);
    }

    public function test_create_a_user_with_special_character_in_name()
    {
        $this->data = array_merge($this->data, [
            'name' => 'Test@',
        ]);

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/register", $this->data);

        $response
        ->assertStatus(422)
        ->assertJson([
            'message' => 'The name must only contain letters and numbers.',
            'errors' => [
                'name'=> [
                    'The name must only contain letters and numbers.'
                ]
            ]
        ]);
    }

}