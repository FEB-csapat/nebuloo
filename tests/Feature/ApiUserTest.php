<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Content;
use App\Models\Question;
use App\Models\User;
use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiUserTest extends TestCase
{
    use DatabaseTransactions;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_update_profile()
    {

        $data = [
            'display_name' => 'Updated name',
            'bio' => 'Updated bio'
        ];

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('/api/me', $data);


        $response->assertOk();
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'display_name' => 'Updated name',
            'bio' => 'Updated bio'
        ]);
    }

    public function test_update_profile_of_other()
    {
        $otherUser = User::factory()->create();

        $data = [
            'display_name' => 'Updated name',
            'bio' => 'Updated bio'
        ];

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('/api/users/' . $otherUser->id, $data);


        $response->assertStatus(403);

        $this->assertDatabaseMissing('users', [
            'id' => $this->user->id,
            'display_name' => 'Updated name',
            'bio' => 'Updated bio'
        ]);
    }

    public function test_update_profile_of_other_as_moderator()
    {
        $moderator = User::factory()->create();
        $moderator->assignRole('moderator');

        $data = [
            'display_name' => 'Updated name',
            'bio' => 'Updated bio'
        ];

        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('/api/users/' . $this->user->id, $data);


        $response->assertOk();
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'display_name' => 'Updated name',
            'bio' => 'Updated bio'
        ]);
    }

    public function test_update_profile_of_other_as_admin()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $data = [
            'display_name' => 'Updated name',
            'bio' => 'Updated bio'
        ];

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('/api/users/' . $this->user->id, $data);


        $response->assertOk();
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'display_name' => 'Updated name',
            'bio' => 'Updated bio'
        ]);
    }



    public function test_delete_profile()
    {
        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete('/api/me');


        $response->assertOk();
        $this->assertDatabaseMissing('users', [
            'id' => $this->user->id
        ]);
    }

    public function test_delete_other_user_as_user()
    {
        $otherUser = User::factory()->create();

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete('/api/users/'.$otherUser->id);


        $response->assertStatus(403);
        $this->assertDatabaseHas('users', [
            'id' => $otherUser->id
        ]);
    }

    public function test_delete_user_as_moderator()
    {
        $moderator = User::factory()->create();
        $moderator->assignRole('moderator');

        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete('/api/users/'.$this->user->id);


        $response->assertStatus(403);
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id
        ]);
    }

    public function test_delete_user_as_admin()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete('/api/users/'.$this->user->id);


        $response->assertOk();
        $this->assertDatabaseMissing('users', [
            'id' => $this->user->id
        ]);
    }

    // TODO fix this
    public function test_delete_self_as_admin()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete('/api/users/'.$admin->id);


        $response->assertStatus(403);
        $this->assertDatabaseHas('users', [
            'id' => $admin->id
        ]);
    }

    public function test_delete_self_as_moderator()
    {
        $moderator = User::factory()->create();
        $moderator->assignRole('moderator');

        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete('/api/users/'.$moderator->id);


        $response->assertStatus(200);
        $this->assertDatabaseMissing('users', [
            'id' => $moderator->id
        ]);
    }


    public function test_delete_other_admin_as_admin()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $this->user->assignRole('admin');

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete('/api/users/'.$this->user->id);


        $response->assertStatus(403);
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id
        ]);
    }

    // tearDown
    protected function tearDown(): void
    {
        $this->user->delete();
        parent::tearDown();
    }
}


