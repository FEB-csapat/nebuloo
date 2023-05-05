<?php

namespace Tests\Feature;
use App\Models\Ticket;
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

        $response->assertForbidden()
        ->assertJson([
            'message' => __('messages.guest_not_permitted_for_action')
        ]);
    }

    public function test_ticket_creation_as_user()
    {

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post('api/tickets', [
            'body' => 'test body'
        ]);
    
        $response->assertCreated();
    }

    public function test_ticket_creation_as_moderator()
    {
        $moderator = User::factory()->create();
        $moderator->setRoleToModerator();

        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post('api/tickets', [
            'body' => 'test body'
        ]);
    
        $response->assertCreated();
        $this->assertDatabaseHas('tickets', [
            'body'=>'test body',
            'creator_user_id' => $moderator->id
        ]);
    }

    public function test_ticket_creation_as_admin()
    {
        $admin = User::factory()->create();
        $admin->setRoleToAdmin();

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post('api/tickets', [
            'body' => 'test body'
        ]);
        
        $response->assertCreated();
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
            ->assertForbidden()
            ->assertJson([
                'message' => __('messages.guest_not_permitted_for_action')
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
        $moderator->setRoleToModerator();
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
        $admin->setRoleToAdmin();
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
        $ticket = Ticket::factory()->create([
            'creator_user_id' => $otherUser->id,
            'body' => 'test body',
            'state' => true
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put("/api/tickets/{$ticket->id}",[
            'state'=> false
        ]);

        $response->assertForbidden();
        $this->assertDatabaseMissing('tickets', [
            'id' => $ticket->id,
            'body' => 'updated ticket'
        ]);
    }

    public function test_update_others_ticket_as_guest()
    {
        $otherUser = User::factory()->create();
        $ticket = Ticket::factory()->create([
            'creator_user_id' => $otherUser->id,
            'body' => 'test body',
            'state' => true
        ]);

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put("/api/tickets/{$ticket->id}",[
            'state' => false
        ]);

        $response->assertForbidden();
        $this->assertDatabaseHas('tickets', [
            'id' => $ticket->id,
            'body' => 'test body',
            'state' => true
        ]);
    }

    public function test_update_others_ticket_as_moderator()
    {
        $otherUser = User::factory()->create();
        $ticket = Ticket::factory()->create([
            'creator_user_id' => $otherUser->id,
            'body' => 'test body',
            'state' => true
        ]);

        $moderator = User::factory()->create();
        $moderator->setRoleToModerator();

        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put("/api/tickets/{$ticket->id}",[
            'state' => false
        ]);


        $response->assertOK();

        $this->assertDatabaseHas('tickets', [
            'id' => $ticket->id,
            'body' => 'test body',
            'state' => false
        ]);
    }

    public function test_update_others_ticket_as_admin()
    {
        $otherUser = User::factory()->create();
        $ticket = Ticket::factory()->create([
            'creator_user_id' => $otherUser->id,
            'body' => 'test body',
            'state' => true
        ]);

        $admin = User::factory()->create();
        $admin->setRoleToAdmin();

        $response = $this->actingAs($admin, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put("/api/tickets/{$ticket->id}",[
            'state'=> false
        ]);


        $response->assertOK();

        $this->assertDatabaseHas('tickets', [
            'id' => $ticket->id,
            'body' => 'test body',
            'state' => false
        ]);
    }

    public function test_update_my_ticket_as_admin()
    {
        $admin = User::factory()->create();
        $admin->setRoleToAdmin();
        
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
    
    public function test_update_my_ticket_as_moderator()
    {
        $moderator = User::factory()->create();
        $moderator->setRoleToModerator();
    
        $ticket = Ticket::factory()->create([
            'creator_user_id' => $moderator->id,
            'body' => 'test body',
            'state' => true
        ]);

        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put("/api/tickets/{$ticket->id}",[
            'state'=> false
        ]);

        $response->assertOK();
        $this->assertDatabaseHas('tickets', [
            'id' => $ticket->id,
            'body' => 'test body',
            'state' => false
        ]);
    }
    
    public function test_update_my_ticket_as_user()
    {
        $ticket = Ticket::factory()->create([
            'creator_user_id' => $this->user->id,
            'body' => 'test body',
            'state' => true
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put("/api/tickets/{$ticket->id}",[
            'state' => false
        ]);

        $response->assertForbidden()
        ->assertJson([
            'message' => __('messages.user_not_permitted_for_action')
        ]);
        $this->assertDatabaseMissing('tickets', [
            'id' => $ticket->id,
            'body' => 'test body',
            'state' => false
        ]);
    }

    public function test_update_my_ticket_as_guest()
    {
    
        $ticket = Ticket::factory()->create(['creator_user_id' => $this->user->id]);

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->put("/api/tickets/{$ticket->id}",[
            'body'=>'updated ticket'
        ]);


        $response
            ->assertForbidden()
            ->assertJson([
                'message' => __('messages.guest_not_permitted_for_action')
        ]);
    }

    public function test_delete_others_ticket_as_user()
    {
        $otherUser = User::factory()->create();
        $ticket = Ticket::factory()->create(['creator_user_id' => $otherUser->id]);

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete("/api/tickets/{$ticket->id}");

        $response->assertForbidden();
        $this->assertDatabaseHas('tickets', [
            'id' => $ticket->id
        ]);
    }
    
    public function test_delete_others_ticket_as_guest()
    {
        $otherUser = User::factory()->create();
        $ticket = Ticket::factory()->create(['creator_user_id' => $otherUser->id]);

        $response = $this
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete("/api/tickets/{$ticket->id}");

        $response
            ->assertForbidden()
            ->assertJson([
                'message' => __('messages.guest_not_permitted_for_action')
        ]);
    }

    public function test_delete_others_ticket_as_moderator()
    {
        $otherUser = User::factory()->create();
        $ticket = Ticket::factory()->create(['creator_user_id' => $otherUser->id]);

        $moderator = User::factory()->create();
        $moderator->setRoleToModerator();

        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete("/api/tickets/{$ticket->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('tickets', [
            'id' => $ticket->id
        ]);
    }

    public function test_delete_others_ticket_as_admin()
    {
        $otherUser = User::factory()->create();
        $ticket = Ticket::factory()->create(['creator_user_id' => $otherUser->id]);

        $admin = User::factory()->create();
        $admin->setRoleToAdmin();

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
        $admin->setRoleToAdmin();

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
    
    public function test_delete_my_ticket_as_moderator()
    {
        $moderator = User::factory()->create();
        $moderator->setRoleToModerator();

        $ticket = Ticket::factory()->create(['creator_user_id' => $moderator->id]);

        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete("/api/tickets/{$ticket->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('tickets', [
            'id' => $ticket->id
        ]);
    }
    
    public function test_delete_my_ticket_as_user()
    {
        $ticket = Ticket::factory()->create(['creator_user_id' => $this->user->id]);

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete("/api/tickets/{$ticket->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('tickets', [
            'id' => $ticket->id
        ]);
    }
}