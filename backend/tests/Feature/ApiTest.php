<?php

namespace Tests\Feature;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

use App\Models\User;

class ApiTest extends TestCase
{
    public function test_api_paths_available()
    {
        $response = $this->get('/api/ranks');
        $response->assertStatus(200);

        $response = $this->get('/api/users');
        $response->assertStatus(200);

        $response = $this->get('/api/contents');
        $response->assertStatus(200);

        $response = $this->get('/api/questions');
        $response->assertStatus(200);

        $response = $this->get('/api/comments');
        $response->assertStatus(200);
    }

    public function test_seeder_through_api()
    {
        $response = $this->get('/api/ranks');
        $response->assertStatus(200);

        $response->assertJson(fn (AssertableJson $json) =>
            $json->has(5)
                ->has('0', fn ($json) =>
                    $json->where('id', 1)
                    ->where('name', 'student')
                    ->etc()
                )
                ->has('1', fn ($json) =>
                    $json->where('id', 2)
                    ->where('name', 'smartass')
                    ->etc()
                )
                ->has('2', fn ($json) =>
                    $json->where('id', 3)
                    ->where('name', 'tutor')
                    ->etc()
                )
                ->has('3', fn ($json) =>
                    $json->where('id', 4)
                    ->where('name', 'teacher')
                    ->etc()
                )
                ->has('4', fn ($json) =>
                    $json->where('id', 5)
                    ->where('name', 'professor')
                    ->etc()
                )
        );
    }


    /*
    // create test for google login
    public function test_google_login()
    {
        $response = $this->get('/api/login/google');

        $response->assertStatus(200);
    }
    */


    

}
