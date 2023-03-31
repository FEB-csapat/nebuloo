<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Content;
use App\Models\Question;
use App\Models\User;
use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiCommentTest extends TestCase
{
    use DatabaseTransactions;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_list_all_comments_for_guest()
    {
        Comment::factory()->create();
        Question::factory()->create();
        
        Comment::factory()->count(3)->create();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/comments');

        $response->assertOk();
    }

    
    public function test_list_all_comments_for_user()
    {
        Comment::factory()->create();
        Question::factory()->create();
        
        Comment::factory()->count(3)->create();

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/comments');

        $response->assertOk();
    }

    
    public function test_list_only_my_comments()
    {
        Comment::factory()->count(3)->create();
        Comment::factory()->count(2)->create(['creator_user_id' => $this->user->id]);

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/me/comments');

        $response->assertOk();
        $response->assertJsonCount(2);
    }

    
    public function test_create_a_comment_on_content_successful()
    {
        $content = Content::factory()->create();

        $data = [
            'message' => 'This is a comment on content'
        ];

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/contents/{$content->id}/comments", $data);

        $response->assertCreated();
        $this->assertDatabaseHas('comments', [
            'message' => 'This is a comment on content',
            'commentable_type' => 'App\Models\Content',
            'commentable_id' => $content->id,
            'creator_user_id' => $this->user->id
        ]);
    }

    
    public function test_create_a_comment_on_question_successful()
    {
        $question = Question::factory()->create();

        $data = [
            'message' => 'This is a comment on question'
        ];
        
        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/questions/{$question->id}/comments", $data);

        $response->assertCreated();
        $this->assertDatabaseHas('comments', [
            'message' => 'This is a comment on question',
            'commentable_type' => 'App\Models\Question',
            'commentable_id' => $question->id,
            'creator_user_id' => $this->user->id
        ]);
    }

    
    public function test_show_a_comment()
    {
        $comment = Comment::factory()->create();

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->get("/api/comments/{$comment->id}");

        $response->assertOk();
        $response->assertJson([
            'id' => $comment->id,
            'message' => $comment->message,
        ]);
    }

    
    public function test_update_others_comment_successful()
    {
        $otherUser = User::factory()->create();
        $comment = Comment::factory()->create(['creator_user_id' => $otherUser->id]);

        $data = [
            'message' => 'Updated comment body'
        ];

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put("/api/me/comments/{$comment->id}", $data);


        $response->assertStatus(403);

        $this->assertDatabaseMissing('comments', [
            'id' => $comment->id,
            'message' => 'Updated comment body'
        ]);
    }

    public function test_update_my_comment()
    {
        $comment = Comment::factory()->create(['creator_user_id' => $this->user->id]);

        $data = [
            'message' => 'Updated comment body'
        ];

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put("/api/me/comments/{$comment->id}", $data);


        $response->assertOk();
        $this->assertDatabaseHas('comments', [
            'id' => $comment->id,
            'message' => 'Updated comment body'
        ]);
    }

    
    
    public function test_delete_others_comment()
    {
        $otherUser = User::factory()->create();
        $comment = Comment::factory()->create(['creator_user_id' => $otherUser->id]);

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete("/api/me/comments/{$comment->id}");

        $response->assertStatus(403);
        $this->assertDatabaseHas('comments', [
            'id' => $comment->id
        ]);
    }

    public function test_delete_my_comment()
    {
        $comment = Comment::factory()->create(['creator_user_id' => $this->user->id]);

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete("/api/me/comments/{$comment->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('comments', [
            'id' => $comment->id
        ]);
    }

    // tearDown
    protected function tearDown(): void
    {
        $this->user->delete();
        parent::tearDown();
    }
}


