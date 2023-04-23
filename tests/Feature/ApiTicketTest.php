<?php

namespace Tests\Feature;
use App\Models\Ticket;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

use App\Models\User;


use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiTicketTest extends TestCase
{
    use DatabaseTransactions;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_ticket_creation_as_guest()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('api/tickets', [
            'body' => 'test body'
        ]);

        $response->assertStatus(403);
    }
    //TODO: User interactions are forbidden
    // public function test_ticket_creation_as_user()
    // {

    //     $response = $this->actingAs($this->user, 'sanctum')
    //     ->withHeaders([
    //         'Accept' => 'application/json',
    //     ])->post('api/tickets', [
    //         'body' => 'test body'
    //     ]);
        
    //     $response->assertStatus(201);
    // }


    //TODO:moderator interactions are forbidden
    // public function test_ticket_creation_as_moderator()
    // {
    //     $moderator = User::factory()->create();
    //     $moderator->assignRole('moderator');

    //     $response = $this->actingAs($moderator, 'sanctum')
    //     ->withHeaders([
    //         'Accept' => 'application/json',
    //     ])->post('api/tickets', [
    //         'body' => 'test body'
    //     ]);
        
    //     $response->assertOk();
    //     $this->assertDatabaseHas('tickets', [
    //         'body'=>'test body',
    //         'creator_user_id' => $moderator->id
    //     ]);
    // }

    public function test_ticket_creation_as_admin()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post('api/tickets', [
            'body' => 'test body'
        ]);
        
        $response->assertStatus(201);
        $this->assertDatabaseHas('tickets', [
            'body'=>'test body',
            'creator_user_id' => $admin->id
        ]);
    }

    public function test_show_only_user_ticket_as_guest()
    {
        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->get('api/tickets/me');

        $response
            ->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthenticated.'
        ]);
    }

    public function test_show_only_user_ticket_as_user()
    {
        $otherUser = User::factory()->create();
        Ticket::factory()->count(3)->create(['creator_user_id' => $otherUser->id]);
        Ticket::factory()->count(2)->create(['creator_user_id' => $this->user->id]);

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->get('api/tickets/me');

        $response->assertOk();
        $response->assertJsonCount(2);
    }

    public function test_show_only_user_ticket_as_moderator()
    {
        $moderator = User::factory()->create();
        $moderator->assignRole('moderator');
        $otherUser = User::factory()->create();
        Ticket::factory()->count(3)->create(['creator_user_id' => $otherUser->id]);
        Ticket::factory()->count(2)->create(['creator_user_id' => $moderator->id]);

        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->get('api/tickets/me');

        $response->assertOk();
        $response->assertJsonCount(2);
    }

    public function test_show_only_user_ticket_as_admin()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $otherUser = User::factory()->create();
        Ticket::factory()->count(3)->create(['creator_user_id' => $otherUser->id]);
        Ticket::factory()->count(2)->create(['creator_user_id' => $admin->id]);

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->get('api/tickets/me');

        $response->assertOk();
        $response->assertJsonCount(2);
    }

    public function test_update_others_ticket_as_user()
    {
        $otherUser = User::factory()->create();
        $ticket = Ticket::factory()->create(['creator_user_id' => $otherUser->id]);

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put("/api/tickets/{$ticket->id}",[
            'body'=>'updated ticket'
        ]);


        $response->assertStatus(403);

        $this->assertDatabaseMissing('tickets', [
            'id' => $ticket->id,
            'body' => 'updated ticket'
        ]);
    }

    public function test_update_others_ticket_as_guest()
    {
        $otherUser = User::factory()->create();
        $ticket = Ticket::factory()->create(['creator_user_id' => $otherUser->id]);

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put("/api/tickets/{$ticket->id}",[
            'body'=>'updated ticket'
        ]);


        $response->assertStatus(403);

        $this->assertDatabaseMissing('tickets', [
            'id' => $ticket->id,
            'body' => 'updated ticket'
        ]);
    }

    public function test_update_others_ticket_as_moderator()
    {
        $otherUser = User::factory()->create();
        $ticket = Ticket::factory()->create(['creator_user_id' => $otherUser->id]);

        $moderator = User::factory()->create();
        $moderator->assignRole('moderator');

        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put("/api/tickets/{$ticket->id}",[
            'body'=>'updated ticket'
        ]);


        $response->assertStatus(403);

        $this->assertDatabaseMissing('tickets', [
            'id' => $ticket->id,
            'body' => 'updated ticket'
        ]);
    }

    public function test_update_others_ticket_as_admin()
    {
        $otherUser = User::factory()->create();
        $ticket = Ticket::factory()->create(['creator_user_id' => $otherUser->id]);

        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put("/api/tickets/{$ticket->id}",[
            'body'=>'updated ticket'
        ]);


        $response->assertOK();

        $this->assertDatabaseHas('tickets', [
            'id' => $ticket->id,
            'body' => 'updated ticket'
        ]);
    }

    public function test_update_my_ticket_as_admin()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        
        $ticket = Ticket::factory()->create(['creator_user_id' => $admin->id]);

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put("/api/tickets/{$ticket->id}",[
            'body'=>'updated ticket'
        ]);


        $response->assertOK();

        $this->assertDatabaseHas('tickets', [
            'id' => $ticket->id,
            'body' => 'updated ticket'
        ]);
    }
//TODO: User interactions are forbidden
    // public function test_update_my_ticket_as_moderator()
    // {
    //     $moderator = User::factory()->create();
    //     $moderator->assignRole('moderator');
        
    //     $ticket = Ticket::factory()->create(['creator_user_id' => $moderator->id]);

    //     $response = $this->actingAs($moderator, 'sanctum')
    //     ->withHeaders([
    //         'Accept' => 'application/json',
    //     ])->put("/api/tickets/{$ticket->id}",[
    //         'body'=>'updated ticket'
    //     ]);


    //     $response->assertOK();

    //     $this->assertDatabaseHas('tickets', [
    //         'id' => $ticket->id,
    //         'body' => 'updated ticket'
    //     ]);
    // }
//TODO: User interactions are forbidden
    // public function test_update_my_ticket_as_user()
    // {
        
    //     $ticket = Ticket::factory()->create(['creator_user_id' => $this->user->id]);

    //     $response = $this->actingAs($this->user, 'sanctum')
    //     ->withHeaders([
    //         'Accept' => 'application/json',
    //     ])->put("/api/tickets/{$ticket->id}",[
    //         'body'=>'updated ticket'
    //     ]);


    //     $response->assertOK();

    //     $this->assertDatabaseHas('tickets', [
    //         'id' => $ticket->id,
    //         'body' => 'updated ticket'
    //     ]);
    // }
//TODO: User interactions are forbidden
    // public function test_update_my_ticket_as_guest()
    // {
        
    //     $ticket = Ticket::factory()->create(['creator_user_id' => $this->user->id]);

    //     $response = $this
    //     ->withHeaders([
    //         'Accept' => 'application/json',
    //     ])->put("/api/tickets/{$ticket->id}",[
    //         'body'=>'updated ticket'
    //     ]);


    //     $response
    //         ->assertStatus(401)
    //         ->assertJson([
    //             'message' => 'Unauthenticated.'
    //     ]);
    // }

    public function test_delete_others_ticket_as_user()
    {
        $otherUser = User::factory()->create();
        $ticket = Ticket::factory()->create(['creator_user_id' => $otherUser->id]);

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete("/api/tickets/{$ticket->id}");

        $response->assertStatus(403);
        $this->assertDatabaseHas('tickets', [
            'id' => $ticket->id
        ]);
    }
//TODO: User interactions are forbidden
    // public function test_delete_others_ticket_as_guest()
    // {
    //     $otherUser = User::factory()->create();
    //     $ticket = Ticket::factory()->create(['creator_user_id' => $otherUser->id]);

    //     $response = $this
    //     ->withHeaders([
    //         'Accept' => 'application/json',
    //     ])->delete("/api/tickets/{$ticket->id}");

    //     $response
    //         ->assertStatus(401)
    //         ->assertJson([
    //             'message' => 'Unauthenticated.'
    //     ]);
    // }

    public function test_delete_others_ticket_as_moderator()
    {
        $otherUser = User::factory()->create();
        $ticket = Ticket::factory()->create(['creator_user_id' => $otherUser->id]);

        $moderator = User::factory()->create();
        $moderator->assignRole('moderator');

        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete("/api/tickets/{$ticket->id}");

        $response
            ->assertStatus(403);
            $this->assertDatabaseHas('tickets', [
                'id' => $ticket->id
            ]);
    }

    public function test_delete_others_ticket_as_admin()
    {
        $otherUser = User::factory()->create();
        $ticket = Ticket::factory()->create(['creator_user_id' => $otherUser->id]);

        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete("/api/tickets/{$ticket->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('tickets', [
            'id' => $ticket->id
        ]);
    }

    public function test_delete_my_ticket_as_admin()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $ticket = Ticket::factory()->create(['creator_user_id' => $admin->id]);

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete("/api/tickets/{$ticket->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('tickets', [
            'id' => $ticket->id
        ]);
    }
//TODO: User interactions are forbidden
    // public function test_delete_my_ticket_as_moderator()
    // {
    //     $moderator = User::factory()->create();
    //     $moderator->assignRole('moderator');

    //     $ticket = Ticket::factory()->create(['creator_user_id' => $moderator->id]);

    //     $response = $this->actingAs($moderator, 'sanctum')
    //     ->withHeaders([
    //         'Accept' => 'application/json',
    //     ])->delete("/api/tickets/{$ticket->id}");

    //     $response->assertOk();
    //     $this->assertDatabaseMissing('tickets', [
    //         'id' => $ticket->id
    //     ]);
    // }
//TODO: User interactions are forbidden
    // public function test_delete_my_ticket_as_user()
    // {
    //     $ticket = Ticket::factory()->create(['creator_user_id' => $this->user->id]);

    //     $response = $this->actingAs($this->user, 'sanctum')
    //     ->withHeaders([
    //         'Accept' => 'application/json',
    //     ])->delete("/api/tickets/{$ticket->id}");

    //     $response->assertOk();
    //     $this->assertDatabaseMissing('tickets', [
    //         'id' => $ticket->id
    //     ]);
    // }
}