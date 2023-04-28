<?php

namespace Tests\Feature;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiUserTest extends TestCase
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
        $this->user->assignRole('user');
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


        $response->assertStatus(403)
        ->assertJson([
            'message' => 'Admin cannot be deleted!'
        ]);
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id
        ]);
    }

    public function test_delete_self_as_moderator()
    {
        $moderator = User::factory()->create();
        $moderator->assignRole('moderator');

        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete('/api/me');


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


        $response->assertStatus(403)
        ->assertJson([
            'message' => 'Admin cannot be deleted!'
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


        $response->assertStatus(403);
        
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'banned' => false
        ]);
    }


    public function test_ban_user_as_admin()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('/api/users/'.$this->user->id.'/ban');


        $response->assertOk();
        
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'banned' => true
        ]);
    }

    public function test_ban_user_as_moderator()
    {
        $moderator = User::factory()->create();
        $moderator->assignRole('moderator');

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
        $admin->assignRole('admin');

        $this->user->assignRole('admin');

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('/api/users/'.$this->user->id.'/ban');


        $response->assertStatus(403);
        
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'banned' => false
        ]);
    }

    public function test_ban_admin_as_moderator()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $this->user->assignRole('moderator');

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('/api/users/'.$admin->id.'/ban');


        $response->assertStatus(403);
        
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'banned' => false
        ]);
    }

    public function test_ban_moderator_as_moderator()
    {
        $moderator = User::factory()->create();
        $moderator->assignRole('moderator');

        $this->user->assignRole('moderator');

        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('/api/users/'.$this->user->id.'/ban');


        $response->assertStatus(403);
        
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'banned' => false
        ]);
    }


    public function test_grant_admin_role_as_admin()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('/api/users/'.$this->user->id.'/role', [
            'role' => 'admin'
        ]);


        $response->assertStatus(200);
        $this->assertTrue($this->user->getRoleNames()->count() == 1);
        $this->assertEquals('admin', $this->user->getRoleNames()[0]);
    }

    public function test_grant_moderator_role_as_admin()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('/api/users/'.$this->user->id.'/role', [
            'role' => 'moderator'
        ]);

        $response->assertStatus(200)
        ->assertJson([
            'id' => $this->user->id,
            'role' => 'moderator',
        ]);
        $this->assertTrue($this->user->getRoleNames()->count() == 1);
        $this->assertEquals('moderator', $this->user->getRoleNames()[0]);
    }

    public function test_grant_user_role_to_moderator_as_admin()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $this->user->assignRole('moderator'); 

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('/api/users/'.$this->user->id.'/role', [
            'role' => 'user'
        ]);


        $response->assertStatus(200);
        $this->assertTrue($this->user->getRoleNames()->count() == 1);
        $this->assertEquals('user', $this->user->getRoleNames()[0]);
    }

    public function test_grant_role_as_moderator()
    {
        $moderator = User::factory()->create();
        $moderator->assignRole('moderator');

        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put('/api/users/'.$this->user->id.'/role', [
            'role' => 'admin'
        ]);

        $response->assertStatus(403);
        $this->assertTrue($this->user->getRoleNames()->count() == 1);
        $this->assertEquals('user', $this->user->getRoleNames()[0]);
    }


    // tearDown
    protected function tearDown(): void
    {
        $this->user->delete();
        parent::tearDown();
    }
}


