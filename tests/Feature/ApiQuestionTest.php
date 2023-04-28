<?php

namespace Tests\Feature;
use App\Models\Question;
use Illuminate\Testing\Fluent\AssertableJson;
use Spatie\Permission\Models\Role;
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

        $adminRole = Role::findOrCreate('admin');
        $moderatorRole = Role::findOrCreate('moderator');
        $userRole = Role::findOrCreate('user');

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
        
        $this->assertDatabaseHas('questions', [
            'title'=>'test title',
            'body'=>'test body',
            'creator_user_id' => $this->user->id
        ]);
    }


    public function test_question_creation_without_title()
    {

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post('api/questions', [
            'body' => 'test body'
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

    public function test_question_creation_without_body()
    {
        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post('api/questions', [
            'title' => 'test title'
        ]);
        
        $response->assertStatus(201);
        $this->assertDatabaseHas('questions', [
            'title'=>'test title',
            'body'=>null,
            'creator_user_id' => $this->user->id
        ]);
    }

    public function test_question_creation_without_body_and_title()
    {
        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post('api/questions', [
            //empty
        ]);
        
        $response
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The title field is required.',
                'errors' => [
                    'title' => [
                        'The title field is required.'
                    ]
                ]
        ]);
    }

    public function test_show_only_user_question_as_guest()
    {
        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->get('api/questions/me');

        $response
            ->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthenticated.'
        ]);
    }

    public function test_show_only_user_question()
    {
        $otherUser = User::factory()->create();
        
        $otherQuestions = Question::factory()->count(2)->create(['creator_user_id' => $otherUser->id]);

        $myQuestions = Question::factory()->count(4)->create(['creator_user_id' => $this->user->id]);

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->get('api/questions/me');

        $response->assertStatus(200);
        $response->assertJsonCount(4);

        $questions = $response->json();

        foreach ($questions as $question) {
            $this->assertEquals($question['creator']['id'], $this->user->id);
        }
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

    public function test_question_update_as_admin()
    {
        $question = Question::factory()->create(['creator_user_id' => $this->user->id]);

        $admin = User::factory()->create();
        $admin->assignRole('admin');


        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('api/questions/'.$question->id, [
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

    public function test_question_update_as_moderator()
    {
        $question = Question::factory()->create(['creator_user_id' => $this->user->id]);

        $moderator = User::factory()->create();
        $moderator->assignRole('moderator');


        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('api/questions/'.$question->id, [
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

    public function test_question_delete_as_guest()
    {
        $question = Question::factory()->create(['creator_user_id' => $this->user->id]);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->delete('api/questions/'.$question->id);
        
        $response
            ->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthenticated.'
        ]);
    }

    public function test_question_delete_as_creator()
    {
        $question = Question::factory()->create(['creator_user_id' => $this->user->id]);

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete('api/questions/'.$question->id);
        
        $response->assertStatus(200);
    }

    public function test_question_delete_as_not_creator()
    {
        $otherUser = User::factory()->create();
        
        $question = Question::factory()->create(['creator_user_id' => $otherUser->id]);


        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete('api/questions/'.$question->id);
        
        $response
            ->assertStatus(403)
            ->assertJson([
                'message' => 'User is not permitted for this action'
        ]);
    }

    public function test_question_delete_as_admin()
    {
        $question = Question::factory()->create(['creator_user_id' => $this->user->id]);

        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete('api/questions/'.$question->id);
        
        $response->assertStatus(200);
    }

    public function test_question_delete_as_moderator()
    {
        $question = Question::factory()->create(['creator_user_id' => $this->user->id]);

        $moderator = User::factory()->create();
        $moderator->assignRole('moderator');


        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete('api/questions/'.$question->id);
        
        $response->assertStatus(200);
    }
}
