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
}
