<?php

namespace Tests\Feature;

use App\Models\Content;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ApiVoteTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function user_can_vote_on_a_content()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $content = Content::factory()->create();

        $response = $this->actingAs($user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/contents/{$content->id}/votes", [
            'direction' => 'up',
        ]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'votable_type' => 'App\Models\Content',
                'votable_id' => $content->id,
                'direction' => 'up',
            ]);

        $voteId = $response->json()['id'];

        $this->assertDatabaseHas('votes', [
            'id' => $voteId,
            'direction' => 'up',
            'votable_type' => 'App\Models\Content',
            'votable_id' => $content->id,
            'owner_user_id' => $user->id,
            'reciever_user_id' => $content->creator_user_id,
        ]);
    }

    /** @test */
    public function user_can_update_their_vote()
    {
        $granter_user = User::factory()->create();
        $reciever_user = User::factory()->create();

        $content = Content::factory()->create(
            [
                'creator_user_id' => $reciever_user->id,
            ]
        );

        // create vote with up direction
        $vote = Vote::factory()->create([
            'owner_user_id' => $granter_user->id,
            'reciever_user_id' => $reciever_user->id,
            'votable_id' => $content->id,
            'votable_type' => Content::class,
            'direction' => 'up'
        ]);

        // update vote with down direction
        $response = $this->actingAs($granter_user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/contents/{$content->id}/votes", [
            'direction' => 'down',
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'id' => $vote->id,
                'votable_type' => 'App\Models\Content',
                'votable_id' => $content->id,
                'direction' => 'down',
            ]);

        $this->assertDatabaseHas('votes', [
            'id' => $vote->id,
            'direction' => 'down',
            'votable_id' => $content->id,
            'votable_type' => Content::class,
            'owner_user_id' => $granter_user->id,
            'reciever_user_id' => $reciever_user->id,
        ]);
    }

    
    /** @test */
    public function user_can_delete_a_vote()
    {
        $granter_user = User::factory()->create();
        $reciever_user = User::factory()->create();

        $content = Content::factory()->create();


        $vote = Vote::factory()->create([
            'owner_user_id' => $granter_user->id,
            'reciever_user_id' => $reciever_user->id,
            'votable_id' => $content->id,
            'votable_type' => Content::class,
            'direction' => 'up'
        ]);

        $response = $this->actingAs($granter_user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete("/api/contents/{$content->id}/votes");
        
        $response->assertStatus(200);
    
        $this->assertDatabaseMissing('votes', [
            'id' => $vote->id,
        ]);
    }
}       