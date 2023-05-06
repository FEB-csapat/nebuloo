<?php

namespace Tests\Feature;

use App\Models\topic;
use App\Models\User;
use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiTopicTest extends TestCase
{
    use DatabaseTransactions;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }
    
    public function test_create_a_topic_as_admin()
    {
        $data = [
            'name' => 'Test'
        ];

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/topics", $data);

        $response->assertCreated();
        $this->assertDatabaseHas('topics', [
            'name' => 'Test'
        ]);
    }

    public function test_create_a_topic_as_moderator()
    {
        $this->user->setRoleToModerator();
        $data = [
            'name' => 'Test'
        ];

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/topics", $data);

        $response->assertCreated();
        $this->assertDatabaseHas('topics', [
            'name' => 'Test'
        ]);
    }


    public function test_create_a_topic_as_user()
    {
        $this->user->setRoleToAdmin();
        $data = [
            'name' => 'Test'
        ];

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/topics", $data);

        $response->assertCreated();
        $this->assertDatabaseHas('topics', [
            'name' => 'Test'
        ]);
    }


    public function test_update_a_topic_as_admin()
    {
        $admin = User::factory()->create([
            'role' => 'admin'
        ]);
        $topic = topic::factory()->create([
            'creator_user_id' => $this->user->id,
            'name' => 'Test'
        ]);

        $data = [
            'name' => 'Updated Test'
        ];

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put("/api/topics/" . $topic->id, $data);

        $response->assertOk();
        $this->assertDatabaseHas('topics', [
            'id' => $topic->id,
            'name' => 'Updated Test'
        ]);
    }

    public function test_update_a_topic_as_moderator()
    {
        $moderator = User::factory()->create([
            'role' => 'moderator'
        ]);
        $topic = topic::factory()->create([
            'creator_user_id' => $this->user->id,
            'name' => 'Test'
        ]);

        $data = [
            'name' => 'Updated Test'
        ];

        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put("/api/topics/" . $topic->id, $data);

        $response->assertOk();
        $this->assertDatabaseHas('topics', [
            'id' => $topic->id,
            'name' => 'Updated Test'
        ]);
    }

    public function test_update_a_topic_as_user()
    {
        $topic = topic::factory()->create([
            'creator_user_id' => $this->user->id,
            'name' => 'Test'
        ]);

        $data = [
            'name' => 'Updated Test'
        ];

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put("/api/topics/" . $topic->id, $data);

        $response->assertForbidden();
        $this->assertDatabaseHas('topics', [
            'id' => $topic->id,
            'name' => 'Test'
        ]);
    }


    public function test_delete_a_topic_as_admin()
    {
        $admin = User::factory()->create([
            'role' => 'admin'
        ]);
        $topic = topic::factory()->create([
            'creator_user_id' => $this->user->id,
            'name' => 'Test'
        ]);

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete("/api/topics/" . $topic->id);

        $response->assertOk();
        $this->assertDatabaseMissing('topics', [
            'id' => $topic->id
        ]);
    }

    public function test_delete_a_topic_as_moderator()
    {
        $moderator = User::factory()->create([
            'role' => 'moderator'
        ]);

        $topic = topic::factory()->create([
            'creator_user_id' => $this->user->id,
            'name' => 'Test'
        ]);

        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete("/api/topics/" . $topic->id);

        $response->assertOk();
        $this->assertDatabaseMissing('topics', [
            'id' => $topic->id
        ]);
    }

    public function test_delete_a_topic_as_user()
    {
        $topic = topic::factory()->create([
            'creator_user_id' => $this->user->id,
            'name' => 'Test'
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete("/api/topics/" . $topic->id);

        $response->assertForbidden();
        $this->assertDatabaseHas('topics', [
            'id' => $topic->id
        ]);
    }


    protected function tearDown(): void
    {
        $this->user->delete();
        parent::tearDown();
    }
}


