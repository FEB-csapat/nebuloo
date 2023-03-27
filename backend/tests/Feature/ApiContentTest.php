<?php

namespace Tests\Feature;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

use App\Models\User;

class ApiContentTest extends TestCase
{
    /**
     * Tests that a user who is not logged in cannot create a content.
     */

    public function test_content_creation_as_unauthorized_user()
    {
        // add accept header to me/contents route
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('api/me/contents', [
            'title' => 'test title',
            'body' => 'test body'
        ]);

        $response->assertStatus(401);

    }

    /**
     * Tests that a user who is not logged in cannot create a content.
     */

    public function test_content_creation_successful()
    {

        $user = User::factory()->withNameAndEmail()->create();

        $response = $this->actingAs($user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post('api/me/contents', [
            'body' => 'test body'
        ]);
        
        $response->assertStatus(201);
    }

    /**
     * Tests that a user who is not logged in cannot create a content.
     */

    public function test_content_creation_failing_without_body()
    {

        $user = User::factory()->withNameAndEmail()->create();

        $response = $this->actingAs($user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post('api/me/contents', [
            // empty
        ]);
        
        $response
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The body field is required.',
                'errors' => [
                    'body' => ['The body field is required.']
                ]
        ]);
    }


    public function test_content_creation_without_title_and_body()
    {

        $user = User::factory()->withNameAndEmail()->create();

        $response = $this->actingAs($user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post('api/me/contents', [
            // empty
        ]);
        
        $response
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The body field is required.',
                'errors' => [
                    'body' => ['The body field is required.']
                ]
        ]);
    }

    public function test_content_update_failing_not_creator()
    {
        $otherUser = User::factory()->withNameAndEmail()->create();
        
        $response = $this->actingAs($otherUser, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post('api/me/contents', [
            'body' => 'test body'
        ]);
        
        $response->assertStatus(201);
        
        $id = $response->json('id');

        $user = User::factory()->withNameAndEmail()->create();

        $response = $this->actingAs($user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('api/me/contents/'.$id, [
            'body' => 'test body updated'
        ]);
        
        $response
            ->assertStatus(403)
            ->assertJson([
                'message' => 'User is not permitted for this action.'
        ]);
    }


    public function test_content_update_successful()
    {
        $user = User::factory()->withNameAndEmail()->create();

        $response = $this->actingAs($user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post('api/me/contents', [
            'body' => 'test body'
        ]);
        
        $response->assertStatus(201);
        
        $id = $response->json('id');


        $response = $this->actingAs($user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('api/me/contents/'.$id, [
            'body' => 'test body updated'
        ]);
        
        $response
            ->assertStatus(200)
            ->assertJson([
                'body' => 'test body updated'
        ]);
    }
}
