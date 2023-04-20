<?php

namespace Tests\Feature;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

use App\Models\User;


use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiQuestionTest extends TestCase
{
    use DatabaseTransactions;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /**
     * Tests that a user who is not logged in cannot create a question.
     */
    public function test_question_creation_as_guest()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('api/questions', [
            'title' => 'test title',
            'body' => 'test body'
        ]);

        $response->assertStatus(401);
    }

    /**
     * Tests that a user who is not logged in cannot create a question.
     */
    public function test_question_creation_as_user()
    {

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post('api/questions', [
            'title' => 'test title',
            'body' => 'test body'
        ]);
        
        $response->assertStatus(201);
    }


    public function test_question_creation_without_title()
    {

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post('api/questions', [
            // empty
        ]);
        
        $response
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The title field is required.',
                'errors' => [
                    'title' => ['The title field is required.']
                ]
        ]);
    }

    public function test_question_update_as_not_creator()
    {
        $otherUser = User::factory()->create();
        
        $response = $this->actingAs($otherUser, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post('api/questions', [
            'title' => 'test title',
            'body' => 'test body'
        ]);
        
        $response->assertStatus(201);
        
        $id = $response->json('id');

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('api/questions/'.$id, [
            'title' => 'test title updated',
            'body' => 'test body updated'
        ]);
        
        $response
            ->assertStatus(403)
            ->assertJson([
                'message' => 'User is not permitted for this action.'
        ]);
    }


    public function test_question_update_as_creator()
    {
        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post('api/questions', [
            'title' => 'test title',
            'body' => 'test body'
        ]);
        
        $response->assertStatus(201);
        
        $id = $response->json('id');


        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('api/questions/'.$id, [
            'title' => 'test title updated',
            'body' => 'test body updated'
        ]);
        
        $response
            ->assertStatus(200)
            ->assertJson([
                'title' => 'test title updated',
                'body' => 'test body updated'
        ]);
    }
}
