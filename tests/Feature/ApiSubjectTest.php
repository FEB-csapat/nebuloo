<?php

namespace Tests\Feature;

use App\Models\Subject;
use App\Models\User;
use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiSubjectTest extends TestCase
{
    use DatabaseTransactions;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }
    
    public function test_create_subject_as_admin()
    {
        $data = [
            'name' => 'Test'
        ];

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/subjects", $data);

        $response->assertCreated();
        $this->assertDatabaseHas('subjects', [
            'name' => 'Test'
        ]);
    }

    public function test_create_subject_as_moderator()
    {
        $this->user->setRoleToModerator();
        $data = [
            'name' => 'Test'
        ];

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/subjects", $data);

        $response->assertCreated();
        $this->assertDatabaseHas('subjects', [
            'name' => 'Test'
        ]);
    }


    public function test_create_subject_as_user()
    {
        $this->user->setRoleToAdmin();
        $data = [
            'name' => 'Test'
        ];

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/subjects", $data);

        $response->assertCreated();
        $this->assertDatabaseHas('subjects', [
            'name' => 'Test'
        ]);
    }


    public function test_update_subject_as_admin()
    {
        $admin = User::factory()->create([
            'role' => 'admin'
        ]);
        $subject = Subject::factory()->create([
            'creator_user_id' => $this->user->id,
            'name' => 'Test'
        ]);

        $data = [
            'name' => 'Updated Test'
        ];

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put("/api/subjects/" . $subject->id, $data);

        $response->assertOk();
        $this->assertDatabaseHas('subjects', [
            'id' => $subject->id,
            'name' => 'Updated Test'
        ]);
    }

    public function test_update_subject_as_moderator()
    {
        $moderator = User::factory()->create([
            'role' => 'moderator'
        ]);
        $subject = Subject::factory()->create([
            'creator_user_id' => $this->user->id,
            'name' => 'Test'
        ]);

        $data = [
            'name' => 'Updated Test'
        ];

        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put("/api/subjects/" . $subject->id, $data);

        $response->assertOk();
        $this->assertDatabaseHas('subjects', [
            'id' => $subject->id,
            'name' => 'Updated Test'
        ]);
    }

    public function test_update_subject_as_user()
    {
        $subject = Subject::factory()->create([
            'creator_user_id' => $this->user->id,
            'name' => 'Test'
        ]);

        $data = [
            'name' => 'Updated Test'
        ];

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put("/api/subjects/" . $subject->id, $data);

        $response->assertForbidden();
        $this->assertDatabaseHas('subjects', [
            'id' => $subject->id,
            'name' => 'Test'
        ]);
    }


    public function test_delete_subject_as_admin()
    {
        $admin = User::factory()->create([
            'role' => 'admin'
        ]);
        $subject = Subject::factory()->create([
            'creator_user_id' => $this->user->id,
            'name' => 'Test'
        ]);

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete("/api/subjects/" . $subject->id);

        $response->assertOk();
        $this->assertDatabaseMissing('subjects', [
            'id' => $subject->id
        ]);
    }

    public function test_delete_subject_as_moderator()
    {
        $moderator = User::factory()->create([
            'role' => 'moderator'
        ]);

        $subject = Subject::factory()->create([
            'creator_user_id' => $this->user->id,
            'name' => 'Test'
        ]);

        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete("/api/subjects/" . $subject->id);

        $response->assertOk();
        $this->assertDatabaseMissing('subjects', [
            'id' => $subject->id
        ]);
    }

    public function test_delete_subject_as_user()
    {
        $subject = Subject::factory()->create([
            'creator_user_id' => $this->user->id,
            'name' => 'Test'
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete("/api/subjects/" . $subject->id);

        $response->assertForbidden();
        $this->assertDatabaseHas('subjects', [
            'id' => $subject->id
        ]);
    }


    protected function tearDown(): void
    {
        $this->user->delete();
        parent::tearDown();
    }
}


