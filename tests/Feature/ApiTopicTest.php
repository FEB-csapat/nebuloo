<?php

namespace Tests\Feature;

use App\Models\Subject;
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
    
    public function test_create_topic_as_admin()
    {
        $subject = Subject::factory()->create([
            'name' => 'Subject Test'
        ]);
        $data = [
            'subject_id' => $subject->id,
            'name' => 'Topic Test'
        ];

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/topics", $data);

        $response->assertCreated();
        $this->assertDatabaseHas('topics', [
            'name' => 'Topic Test'
        ]);
    }

    public function test_create_topic_as_moderator()
    {
        $this->user->setRoleToModerator();
        $subject = Subject::factory()->create([
            'name' => 'Subject Test'
        ]);
        $data = [
            'subject_id' => $subject->id,
            'name' => 'Topic Test'
        ];

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/topics", $data);

        $response->assertCreated();
        $this->assertDatabaseHas('topics', [
            'name' => 'Topic Test'
        ]);
    }


    public function test_create_topic_as_user()
    {
        $subject = Subject::factory()->create([
            'name' => 'Subject Test'
        ]);
        $data = [
            'subject_id' => $subject->id,
            'name' => 'Topic Test'
        ];

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/topics", $data);

        $response->assertCreated();
        $this->assertDatabaseHas('topics', [
            'name' => 'Topic Test'
        ]);
    }



    public function test_create_topic_without_subject()
    {
        $data = [
            'name' => 'Test'
        ];

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/topics", $data);

        $response->assertUnprocessable();
        $this->assertDatabaseMissing('topics', [
            'name' => 'Test'
        ]);
    }


    public function test_update_topic_as_admin()
    {
        $admin = User::factory()->create([
            'role' => 'admin'
        ]);

        $topic = Topic::factory()->create([
            'creator_user_id' => $this->user->id,
            'name' => 'Test'
        ]);

        $otherSubject = Subject::factory()->create([
            'name' => 'Other Subject Test'
        ]);

        $data = [
            'subject_id' => $otherSubject->id,
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

    public function test_update_topic_as_moderator()
    {
        $moderator = User::factory()->create([
            'role' => 'moderator'
        ]);
        $topic = Topic::factory()->create([
            'creator_user_id' => $this->user->id,
            'name' => 'Test'
        ]);

        $otherSubject = Subject::factory()->create([
            'name' => 'Other Subject Test'
        ]);

        $data = [
            'subject_id' => $otherSubject->id,
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

    public function test_update_topic_as_user()
    {
        $topic = Topic::factory()->create([
            'creator_user_id' => $this->user->id,
            'name' => 'Test'
        ]);

        $otherSubject = Subject::factory()->create([
            'name' => 'Other Subject Test'
        ]);

        $data = [
            'subject_id' => $otherSubject->id,
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

    public function test_delete_topic_as_admin()
    {
        $admin = User::factory()->create([
            'role' => 'admin'
        ]);
        $topic = Topic::factory()->create([
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

    public function test_delete_topic_as_moderator()
    {
        $moderator = User::factory()->create([
            'role' => 'moderator'
        ]);

        $topic = Topic::factory()->create([
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

    public function test_delete_topic_as_user()
    {
        $topic = Topic::factory()->create([
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


