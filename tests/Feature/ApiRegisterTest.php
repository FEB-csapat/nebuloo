<?php

namespace Tests\Feature;

use App\Models\User;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use Tests\TestCase;

class ApiRegisterTest extends TestCase
{
    private $user;
    public function test_create_a_user()
    {
        $data = [
            'id'=>55000,
            'name' => 'Test User',
            'email' => 'Testing@test.test',
            'password' => 'Test123@',
            'password_confirmation' => 'Test123@'
        ];
    
        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/register", $data);
        $response->assertCreated();
            $this->assertDatabaseHas('users', [
                'name' => 'Test User',
                'email' => 'Testing@test.test'
            ]);

    }

     public function test_create_a_user_with_mismatched_password()
     {
         $data = [
             'name' => 'Test User1',
             'email' => 'Testing@test.test1',
             'password' => 'Test123@',
             'password_confirmation' => 'Test12@'
         ];
    
         $response = $this
         ->withHeaders([
             'Accept' => 'application/json',
         ])->post("/api/register", $data);
    
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
         $data = [
             'name' => 'Test User2',
             'email' => 'Testing@test.test2',
             'password' => 'Test12345',
             'password_confirmation' => 'Test12345'
         ];
    
         $response = $this
         ->withHeaders([
             'Accept' => 'application/json',
         ])->post("/api/register", $data);
    
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
         $data = [
             'name' => 'Test User3',
             'email' => 'Testing@test.test3',
             'password' => 'Te',
             'password_confirmation' => 'Te'
         ];
    
         $response = $this
         ->withHeaders([
             'Accept' => 'application/json',
         ])->post("/api/register", $data);
    
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
         $data = [
             'name' => 'Test User4',
             'email' => 'Testing@test.test4',
             'password' => 'testing123@',
             'password_confirmation' => 'testing123@'
         ];
    
         $response = $this
         ->withHeaders([
             'Accept' => 'application/json',
         ])->post("/api/register", $data);
    
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
         $data = [
             'name' => 'Test User5',
             'email' => 'Testing@test.test5',
             'password' => 'testingtest@',
             'password_confirmation' => 'testingtest@'
         ];
    
         $response = $this
         ->withHeaders([
             'Accept' => 'application/json',
         ])->post("/api/register", $data);
    
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
         $data = [
             'name' => 'Test User6',
             'email' => 'Testing@test.test6',
             'password' => 'TESTINGTEST12@',
             'password_confirmation' => 'TESTINGTEST12@'
         ];
    
         $response = $this
         ->withHeaders([
             'Accept' => 'application/json',
         ])->post("/api/register", $data);
    
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
         $data = [
             'name' => 'Test User7',
             'email' => 'Testing@test.test7',
             'password' => 'TESTINGTESt12@'
         ];
    
         $response = $this
         ->withHeaders([
             'Accept' => 'application/json',
         ])->post("/api/register", $data);
    
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
         $data = [
             'name' => 'Test User8',
             'password' => 'TESTINGTESt12@',
             'password_confirmation' => 'TESTINGTESt12@'
         ];
    
         $response = $this
         ->withHeaders([
             'Accept' => 'application/json',
         ])->post("/api/register", $data);
    
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
         $data = [
             'email' => 'Testing@test.test9',
             'password' => 'TESTINGTESt12@',
             'password_confirmation' => 'TESTINGTESt12@'
         ];
    
         $response = $this
         ->withHeaders([
             'Accept' => 'application/json',
         ])->post("/api/register", $data);
    
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
         $data = [
            'name' => 'Test User10',
             'email' => 'Testingtesttest',
             'password' => 'TESTINGTESt12@',
             'password_confirmation' => 'TESTINGTESt12@'
         ];
    
         $response = $this
         ->withHeaders([
             'Accept' => 'application/json',
         ])->post("/api/register", $data);
    
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
         $data = [
            'name' => 'Te',
             'email' => 'Testing@test.test121',
             'password' => 'TESTINGTESt12@',
             'password_confirmation' => 'TESTINGTESt12@'
         ];
    
         $response = $this
         ->withHeaders([
             'Accept' => 'application/json',
         ])->post("/api/register", $data);
    
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
         $data = [
            'name' => 'TestTestTestTestTestTestTest',
             'email' => 'Testing@test.test122',
             'password' => 'TESTINGTESt12@',
             'password_confirmation' => 'TESTINGTESt12@'
         ];
    
         $response = $this
         ->withHeaders([
             'Accept' => 'application/json',
         ])->post("/api/register", $data);
    
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
         $data = [
            'name' => 'Test11',
             'email' => 'Testing@test.test123'
         ];
    
         $response = $this
         ->withHeaders([
             'Accept' => 'application/json',
         ])->post("/api/register", $data);
    
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
     public function test_create_a_user_that_already_exists()
     {
         $data = [
            'name' => 'Test User',
            'email' => 'Testing@test.test',
            'password' => 'Test123@',
            'password_confirmation' => 'Test123@'
         ];
    
         $response = $this
         ->withHeaders([
             'Accept' => 'application/json',
         ])->post("/api/register", $data);
    
         $response
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The name has already been taken. (and 1 more error)',
                'errors' => [
                    'name'=> [
                        'The name has already been taken.'
                    ],
                    'email'=> [
                        'The email has already been taken.'
                    ]
                ]
        ]);
     }

}