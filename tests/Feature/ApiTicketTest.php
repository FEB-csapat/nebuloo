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

    public function test_ticket_creation_as_moderator()
    {
        $moderator = User::factory()->create();
        $moderator->assignRole('moderator');

        $response = $this->actingAs($moderator, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post('api/tickets', [
            'body' => 'test body'
        ]);
        
        $response->assertOk();
        $this->assertDatabaseHas('tickets', [
            'body'=>'test body',
            'creator_user_id' => $moderator->id
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

}