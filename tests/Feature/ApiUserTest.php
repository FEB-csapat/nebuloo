<?php

namespace Tests\Feature;
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

        $this->user = User::factory()->create([
            'role' => 'user'
        ]);
    }

    public function test_update_profile_as_user()
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

    public function test_update_profile_of_other_as_user()
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


        $response->assertForbidden();

        $this->assertDatabaseMissing('users', [
            'id' => $this->user->id,
            'display_name' => 'Updated name',
            'bio' => 'Updated bio'
        ]);
    }

    public function test_update_profile_of_other_as_moderator()
    {
        $moderator = User::factory()->create();
        $moderator->setRoleToModerator();

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
        $admin->setRoleToAdmin();

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



    public function test_delete_user_self()
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


        $response->assertForbidden();
        $this->assertDatabaseHas('users', [
            'id' => $otherUser->id
        ]);
    }

    public function test_delete_user_as_moderator()
    {
        $moderator = User::factory()->create();
        $moderator->setRoleToModerator();

        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete('/api/users/'.$this->user->id);


        $response->assertForbidden();
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id
        ]);
    }

    public function test_delete_user_as_admin()
    {
        $admin = User::factory()->create();
        $admin->setRoleToAdmin();

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete('/api/users/'.$this->user->id);

        $response->assertOk();
        $this->assertDatabaseMissing('users', [
            'id' => $this->user->id
        ]);
    }

    public function test_delete_self_as_admin()
    {
        $admin = User::factory()->create();
        $admin->setRoleToAdmin();

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete('/api/users/'.$admin->id);


        $response->assertForbidden()
        ->assertJson([
            'message' => __('messages.admin_cannot_be_deleted')
        ]);
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id
        ]);
    }

    public function test_delete_self_as_moderator()
    {
        $moderator = User::factory()->create();
        $moderator->setRoleToModerator();

        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete('/api/me');


        $response->assertOk();
        $this->assertDatabaseMissing('users', [
            'id' => $moderator->id
        ]);
    }


    public function test_delete_other_admin_as_admin()
    {
        $admin = User::factory()->create();
        $admin->setRoleToAdmin();

        $this->user->setRoleToAdmin();

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete('/api/users/'.$this->user->id);


        $response->assertForbidden()
        ->assertJson([
            'message' => __('messages.admin_cannot_be_deleted')
        ]);
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id
        ]);
    }


    public function test_ban_user_as_user()
    {
        $otherUser = User::factory()->create();
        
        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('/api/users/'.$otherUser->id.'/ban');


        $response->assertForbidden();
        
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'banned' => false
        ]);
    }


    public function test_ban_user_as_admin()
    {
        $admin = User::factory()->create();
        $admin->setRoleToAdmin();

        $otherUser = User::factory()->create();

        $this->assertNotEquals($admin->id, $otherUser->id);

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('/api/users/'.$otherUser->id.'/ban');


        $response->assertOk();
        
        $this->assertDatabaseHas('users', [
            'id' => $otherUser->id,
            'banned' => true
        ]);
    }

    public function test_ban_user_as_moderator()
    {
        $moderator = User::factory()->create();
        $moderator->setRoleToModerator();

        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('/api/users/'.$this->user->id.'/ban');


        $response->assertOk();
        
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'banned' => true
        ]);
    }


    public function test_ban_admin_as_admin()
    {
        $admin = User::factory()->create();
        $admin->setRoleToAdmin();

        $this->assertEquals('admin', $admin->role);


        $otherUser = User::factory()->create();
        $otherUser->setRoleToAdmin();

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('/api/users/'.$otherUser->id.'/ban');


        $response->assertForbidden();
        $this->assertDatabaseHas('users', [
            'id' => $otherUser->id,
            'banned' => false
        ]);
    }

    public function test_ban_admin_as_moderator()
    {
        $admin = User::factory()->create();
        $admin->setRoleToAdmin();

        $this->user->setRoleToModerator();

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('/api/users/'.$admin->id.'/ban');


        $response->assertForbidden();
        
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'banned' => false
        ]);
    }

    public function test_ban_moderator_as_moderator()
    {
        $moderator = User::factory()->create();
        $moderator->setRoleToModerator();

        $this->user->setRoleToModerator();

        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('/api/users/'.$this->user->id.'/ban');


        $response->assertForbidden();
        
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'banned' => false
        ]);
    }


    public function test_grant_admin_role_as_admin()
    {
        $admin = User::factory()->create();
        $admin->setRoleToAdmin();

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('/api/users/'.$this->user->id.'/role', [
            'role' => 'admin'
        ]);


        $response->assertOk()
        ->assertJson([
            'id' => $this->user->id,
            'role' => 'admin'
        ]);
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'role' => 'admin'
        ]);
    }

    public function test_grant_moderator_role_as_admin()
    {
        $admin = User::factory()->create();
        $admin->setRoleToAdmin();

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('/api/users/'.$this->user->id.'/role', [
            'role' => 'moderator'
        ]);

        $response->assertOk()
        ->assertJson([
            'id' => $this->user->id,
            'role' => 'moderator',
        ]);
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'role' => 'moderator'
        ]);
    }

    public function test_grant_user_role_to_moderator_as_admin()
    {
        $admin = User::factory()->create();
        $admin->setRoleToAdmin();

        $this->user->setRoleToModerator(); 

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('/api/users/'.$this->user->id.'/role', [
            'role' => 'user'
        ]);


        $response->assertOk()
        ->assertJson([
            'id' => $this->user->id,
            'role' => 'user',
        ]);
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'role' => 'user'
        ]);
    }

    public function test_grant_role_as_moderator()
    {
        $moderator = User::factory()->create([
            'role' => 'moderator'
        ]);

        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('/api/users/'.$this->user->id.'/role', [
            'role' => 'admin'
        ]);

        $response->assertForbidden();

        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'role' => 'user'
        ]);
    }


    protected function tearDown(): void
    {
        $this->user->delete();
        parent::tearDown();
    }
}


