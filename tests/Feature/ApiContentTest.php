<?php

namespace Tests\Feature;

use App\Models\Content;
use Tests\TestCase;

use App\Models\User;

use Illuminate\Foundation\Testing\DatabaseTransactions;
class ApiContentTest extends TestCase
{
    use DatabaseTransactions;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_show_only_user_content()
    {
        $otherUser = User::factory()->create();
        
        $otherContents = Content::factory()->count(2)->create(['creator_user_id' => $otherUser->id]);

        $myContents = Content::factory()->count(4)->create(['creator_user_id' => $this->user->id]);

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->get('api/contents/me');

        $response->assertStatus(200);
        $response->assertJsonCount(4);

        $contents = $response->json();

        foreach ($contents as $content) {
            $this->assertEquals($content['creator']['id'], $this->user->id);
        }
    }


    public function test_show_only_user_content_as_guest()
    {
        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->get('api/contents/me');

        $response
            ->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthenticated.'
        ]);
    }

    public function test_content_creation_as_unauthorized_user()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('api/contents', [
            'title' => 'test title',
            'body' => 'test body'
        ]);

        $response->assertStatus(401);
    }

    
    public function test_content_creation_as_user()
    {
        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post('api/contents', [
            'body' => 'test body'
        ]);
        
        $response->assertStatus(201);
    }

    public function test_content_creation_without_body()
    {
        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post('api/contents', [
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

    public function test_content_update_as_guest()
    {
        $content = Content::factory()->create(['creator_user_id' => $this->user->id]);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->put('api/contents/'.$content->id, [
            'body' => 'test body updated'
        ]);
        
        $response
            ->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthenticated.'
        ]);
    }

    public function test_content_update_as_not_creator()
    {
        $otherUser = User::factory()->create();
        
        $content = Content::factory()->create(['creator_user_id' => $otherUser->id]);


        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('api/contents/'.$content->id, [
            'body' => 'test body updated'
        ]);
        
        $response
            ->assertStatus(403)
            ->assertJson([
                'message' => 'User is not permitted for this action.'
        ]);
    }

    public function test_content_update_as_creator()
    {
        $content = Content::factory()->create(['creator_user_id' => $this->user->id]);

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('api/contents/'.$content->id, [
            'body' => 'test body updated'
        ]);
        
        $response
            ->assertStatus(200)
            ->assertJson([
                'body' => 'test body updated'
        ]);
    }

    public function test_content_update_as_admin()
    {
        $content = Content::factory()->create(['creator_user_id' => $this->user->id]);

        $admin = User::factory()->create();
        $admin->assignRole('admin');


        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('api/contents/'.$content->id, [
            'body' => 'test body updated'
        ]);
        
        $response
            ->assertStatus(200)
            ->assertJson([
                'body' => 'test body updated'
        ]);
    }

    public function test_content_update_as_moderator()
    {
        $content = Content::factory()->create(['creator_user_id' => $this->user->id]);

        $moderator = User::factory()->create();
        $moderator->assignRole('moderator');


        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('api/contents/'.$content->id, [
            'body' => 'test body updated'
        ]);
        
        $response
            ->assertStatus(200)
            ->assertJson([
                'body' => 'test body updated'
        ]);
    }


    public function test_content_delete_as_guest()
    {
        $content = Content::factory()->create(['creator_user_id' => $this->user->id]);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->delete('api/contents/'.$content->id);
        
        $response
            ->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthenticated.'
        ]);
    }

    public function test_content_delete_as_creator()
    {
        $content = Content::factory()->create(['creator_user_id' => $this->user->id]);

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete('api/contents/'.$content->id);
        
        $response->assertStatus(200);
    }

    public function test_content_delete_as_not_creator()
    {
        $otherUser = User::factory()->create();
        
        $content = Content::factory()->create(['creator_user_id' => $otherUser->id]);


        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete('api/contents/'.$content->id);
        
        $response
            ->assertStatus(403)
            ->assertJson([
                'message' => 'User is not permitted for this action'
        ]);
    }
    
    public function test_content_delete_as_admin()
    {
        $content = Content::factory()->create(['creator_user_id' => $this->user->id]);

        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete('api/contents/'.$content->id);
        
        $response->assertStatus(200);
    }

    public function test_content_delete_as_moderator()
    {
        $content = Content::factory()->create(['creator_user_id' => $this->user->id]);

        $moderator = User::factory()->create();
        $moderator->assignRole('moderator');


        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete('api/contents/'.$content->id);
        
        $response->assertStatus(200);
    }
}
