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

        $this->user = User::factory()->create([
            
        ]);
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

        $response->assertOk();
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
            ->assertUnauthorized()
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

        $response->assertUnauthorized();
    }

    
    public function test_content_creation_as_user()
    {
        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post('api/contents', [
            'body' => 'test body'
        ]);
        
        $response->assertCreated();
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
            ->assertUnprocessable()
            ->assertJson([
                'message' => 'A(z) leírás mező kitöltése kötelező.',
                'errors' => [
                    'body' => ['A(z) leírás mező kitöltése kötelező.']
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
            ->assertUnauthorized()
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
            ->assertForbidden()
            ->assertJson([
                'message' => __('messages.user_not_permitted_for_action')
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
            ->assertOk()
            ->assertJson([
                'body' => 'test body updated'
        ]);
    }

    public function test_content_update_as_admin()
    {
        $content = Content::factory()->create(['creator_user_id' => $this->user->id]);

        $admin = User::factory()->create();
        $admin->setRoleToAdmin();


        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('api/contents/'.$content->id, [
            'body' => 'test body updated'
        ]);
        
        $response
            ->assertOk()
            ->assertJson([
                'body' => 'test body updated'
        ]);
    }

    public function test_content_update_as_moderator()
    {
        $content = Content::factory()->create(['creator_user_id' => $this->user->id]);

        $moderator = User::factory()->create();
        $moderator->setRoleToModerator();


        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('api/contents/'.$content->id, [
            'body' => 'test body updated'
        ]);
        
        $response
            ->assertOk()
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
            ->assertUnauthorized()
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
        
        $response->assertOk();
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
            ->assertForbidden()
            ->assertJson([
                'message' => __('messages.user_not_permitted_for_action')
        ]);
    }
    
    public function test_content_delete_as_admin()
    {
        $content = Content::factory()->create(['creator_user_id' => $this->user->id]);

        $admin = User::factory()->create();
        $admin->setRoleToAdmin();

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete('api/contents/'.$content->id);
        
        $response->assertOk();
    }

    public function test_content_delete_as_moderator()
    {
        $content = Content::factory()->create(['creator_user_id' => $this->user->id]);

        $moderator = User::factory()->create();
        $moderator->setRoleToModerator();


        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete('api/contents/'.$content->id);
        
        $response->assertOk();
    }
}
