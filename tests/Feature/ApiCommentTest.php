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
        $otherUser = User::factory()->create();
        Comment::factory()->count(3)->create(['creator_user_id' => $otherUser->id]);
        Comment::factory()->count(2)->create(['creator_user_id' => $this->user->id]);

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/comments/me');

        $response->assertOk();
        $response->assertJsonCount(2);
    }

    public function test_list_only_user_comment_as_guest()
    {
        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->get('api/comments/me');

        $response
            ->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthenticated.'
        ]);
    }

    
    public function test_create_a_comment_on_content_as_user()
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

    public function test_create_a_comment_on_content_as_admin()
    {
        $content = Content::factory()->create();

        $admin = User::factory()->create();
        $admin->setRoleToAdmin();

        $data = [
            'message' => 'This is a comment on content'
        ];

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/contents/{$content->id}/comments", $data);

        $response->assertCreated();
        $this->assertDatabaseHas('comments', [
            'message' => 'This is a comment on content',
            'commentable_type' => 'App\Models\Content',
            'commentable_id' => $content->id,
            'creator_user_id' => $admin->id
        ]);
    }

    public function test_create_a_comment_on_content_as_moderator()
    {
        $content = Content::factory()->create();

        $moderator = User::factory()->create();
        $moderator->setRoleToModerator();

        $data = [
            'message' => 'This is a comment on content'
        ];

        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/contents/{$content->id}/comments", $data);

        $response->assertCreated();
        $this->assertDatabaseHas('comments', [
            'message' => 'This is a comment on content',
            'commentable_type' => 'App\Models\Content',
            'commentable_id' => $content->id,
            'creator_user_id' => $moderator->id
        ]);
    }

    public function test_create_a_comment_on_content_as_guest()
    {
        $content = Content::factory()->create();

        $data = [
            'message' => 'This is a comment on content'
        ];

        $response = $this->
        withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/contents/{$content->id}/comments", $data);

        $response
        ->assertStatus(401)
        ->assertJson([
            'message' => 'Unauthenticated.'
        ]);
    }
    
    public function test_create_a_comment_on_question_as_user()
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

    public function test_create_a_comment_on_question_as_admin()
    {
        $question = Question::factory()->create();

        $admin = User::factory()->create();
        $admin->setRoleToAdmin();

        $data = [
            'message' => 'This is a comment on question'
        ];
        
        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/questions/{$question->id}/comments", $data);

        $response->assertCreated();
        $this->assertDatabaseHas('comments', [
            'message' => 'This is a comment on question',
            'commentable_type' => 'App\Models\Question',
            'commentable_id' => $question->id,
            'creator_user_id' => $admin->id
        ]);
    }

    public function test_create_a_comment_on_question_as_moderator()
    {
        $question = Question::factory()->create();

        $moderator = User::factory()->create();
        $moderator->setRoleToModerator();

        $data = [
            'message' => 'This is a comment on question'
        ];
        
        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/questions/{$question->id}/comments", $data);

        $response->assertCreated();
        $this->assertDatabaseHas('comments', [
            'message' => 'This is a comment on question',
            'commentable_type' => 'App\Models\Question',
            'commentable_id' => $question->id,
            'creator_user_id' => $moderator->id
        ]);
    }

    public function test_create_a_comment_on_question_as_guest()
    {
        $question = Question::factory()->create();

        $data = [
            'message' => 'This is a comment on question'
        ];

        $response = $this->
        withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/questions/{$question->id}/comments", $data);

        $response
        ->assertStatus(401)
        ->assertJson([
            'message' => 'Unauthenticated.'
        ]);
    }

    
    public function test_show_a_comment_as_user()
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

    public function test_show_a_comment_as_admin()
    {
        $comment = Comment::factory()->create();

        $admin = User::factory()->create();
        $admin->setRoleToAdmin();

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->get("/api/comments/{$comment->id}");

        $response->assertOk();
        $response->assertJson([
            'id' => $comment->id,
            'message' => $comment->message,
        ]);
    }

    public function test_show_a_comment_as_moderator()
    {
        $comment = Comment::factory()->create();

        $moderator = User::factory()->create();
        $moderator->setRoleToModerator();

        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->get("/api/comments/{$comment->id}");

        $response->assertOk();
        $response->assertJson([
            'id' => $comment->id,
            'message' => $comment->message,
        ]);
    }

public function test_show_a_comment_as_guest()
    {
        $comment = Comment::factory()->create();

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->get("/api/comments/{$comment->id}");

        $response->assertOk();
        $response->assertJson([
            'id' => $comment->id,
            'message' => $comment->message,
        ]);
    }
    
    public function test_update_others_comment_as_user()
    {
        $otherUser = User::factory()->create();
        $comment = Comment::factory()->create(['creator_user_id' => $otherUser->id]);

        $data = [
            'message' => 'Updated comment body'
        ];

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put("/api/comments/{$comment->id}", $data);


        $response->assertStatus(403);

        $this->assertDatabaseMissing('comments', [
            'id' => $comment->id,
            'message' => 'Updated comment body'
        ]);
    }

    public function test_update_others_comment_as_guest()
    {
        $otherUser = User::factory()->create();
        $comment = Comment::factory()->create(['creator_user_id' => $otherUser->id]);

        $data = [
            'message' => 'Updated comment body'
        ];

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put("/api/comments/{$comment->id}", $data);


        $response
        ->assertStatus(401)
        ->assertJson([
            'message' => 'Unauthenticated.'
        ]);
    }

    public function test_update_others_comment_as_moderator()
    {
        $otherUser = User::factory()->create();
        $comment = Comment::factory()->create(['creator_user_id' => $otherUser->id]);

        $moderator = User::factory()->create(['role' => 'moderator']);
        
        $data = [
            'message' => 'Updated comment body'
        ];

        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put("/api/comments/{$comment->id}", $data);


        $response->assertOk();
        $this->assertDatabaseHas('comments', [
            'id' => $comment->id,
            'message' => 'Updated comment body'
        ]);
    }

    public function test_update_others_comment_as_admin()
    {
        $otherUser = User::factory()->create();
        $comment = Comment::factory()->create(['creator_user_id' => $otherUser->id]);

        $admin = User::factory()->create();
        $admin->setRoleToAdmin();

        $data = [
            'message' => 'Updated comment body'
        ];

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put("/api/comments/{$comment->id}", $data);


        $response->assertOk();
        $this->assertDatabaseHas('comments', [
            'id' => $comment->id,
            'message' => 'Updated comment body'
        ]);
    }

    public function test_update_comment_as_creator()
    {
        $comment = Comment::factory()->create(['creator_user_id' => $this->user->id]);

        $data = [
            'message' => 'Updated comment body'
        ];

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put("/api/comments/{$comment->id}", $data);


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
        ])->delete("/api/comments/{$comment->id}");

        $response->assertStatus(403);
        $this->assertDatabaseHas('comments', [
            'id' => $comment->id
        ]);
    }

    public function test_delete_others_comment_as_guest()
    {
        $otherUser = User::factory()->create();
        $comment = Comment::factory()->create(['creator_user_id' => $otherUser->id]);

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete("/api/comments/{$comment->id}");

        $response
            ->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthenticated.'
        ]);
    }

    public function test_delete_others_comment_as_moderator()
    {
        $otherUser = User::factory()->create();
        $comment = Comment::factory()->create(['creator_user_id' => $otherUser->id]);

        $moderator = User::factory()->create();
        $moderator->setRoleToModerator();

        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete("/api/comments/{$comment->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('comments', [
            'id' => $comment->id
        ]);
    }

    public function test_delete_others_comment_as_admin()
    {
        $otherUser = User::factory()->create();
        $comment = Comment::factory()->create(['creator_user_id' => $otherUser->id]);

        $admin = User::factory()->create();
        $admin->setRoleToAdmin();

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete("/api/comments/{$comment->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('comments', [
            'id' => $comment->id
        ]);
    }

    public function test_delete_comment_as_creator()
    {
        $comment = Comment::factory()->create(['creator_user_id' => $this->user->id]);

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete("/api/comments/{$comment->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('comments', [
            'id' => $comment->id
        ]);
    }

    public function test_delete_my_comment_as_admin()
    {
        $admin = User::factory()->create();
        $admin->setRoleToAdmin();

        $comment = Comment::factory()->create(['creator_user_id' => $admin->id]);

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete("/api/comments/{$comment->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('comments', [
            'id' => $comment->id
        ]);
    }

    public function test_delete_my_comment_as_moderator()
    {
        $moderator = User::factory()->create();
        $moderator->setRoleToModerator();

        $comment = Comment::factory()->create(['creator_user_id' => $moderator->id]);

        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete("/api/comments/{$comment->id}");

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


