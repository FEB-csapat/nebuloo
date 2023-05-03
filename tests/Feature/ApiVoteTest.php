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


    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /** @test */
    public function test_user_can_vote_on_a_content()
    {
        $content = Content::factory()->create([
            'creator_user_id' => $this->user->id,
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/contents/{$content->id}/votes", [
            'direction' => 'up',
        ]);

        $response
            ->assertCreated()
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
            'creator_user_id' => $this->user->id,
            'reciever_user_id' => $content->creator_user_id,
        ]);
    }

    /** @test */
    public function test_user_can_update_their_vote()
    {
        $reciever_user = User::factory()->create();

        $content = Content::factory()->create([
            'creator_user_id' => $reciever_user->id,
        ]);

        // create vote with up direction
        $vote = Vote::factory()->create([
            'creator_user_id' => $this->user->id,
            'reciever_user_id' => $reciever_user->id,
            'votable_id' => $content->id,
            'votable_type' => Content::class,
            'direction' => 'up'
        ]);

        // update vote with down direction
        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/contents/{$content->id}/votes", [
            'direction' => 'down',
        ]);

        $response
            ->assertOk()
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
            'creator_user_id' => $this->user->id,
            'reciever_user_id' => $reciever_user->id,
        ]);
    }

    
    /** @test */
    public function test_user_can_delete_a_vote()
    {
        $reciever_user = User::factory()->create();

        $content = Content::factory()->create([
            'creator_user_id' => $reciever_user->id,
        ]);

        $vote = Vote::factory()->create([
            'creator_user_id' => $this->user->id,
            'reciever_user_id' => $reciever_user->id,
            'votable_id' => $content->id,
            'votable_type' => Content::class,
            'direction' => 'up'
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->delete("/api/contents/{$content->id}/votes");
        
        $response->assertOk();
    
        $this->assertDatabaseMissing('votes', [
            'id' => $vote->id,
        ]);
    }

    public function test_user_can_vote_only_once()
    {
        $content = Content::factory()->create([
            'creator_user_id' => $this->user->id,
        ]);

        $vote = Vote::factory()->create([
            'creator_user_id' => $this->user->id,
            'reciever_user_id' => $content->creator->id,
            'votable_id' => $content->id,
            'votable_type' => Content::class,
            'direction' => 'up'
        ]);

        $response = $this->actingAs($this->user, 'sanctum')
        ->withHeaders([
            'Accept' => 'application/json',
        ])->post("/api/contents/{$content->id}/votes", [
            'direction' => 'up',
        ]);

        $response
            ->assertOk()
            ->assertJson([
                'votable_type' => 'App\Models\Content',
                'votable_id' => $content->id,
                'direction' => 'up',
            ]);

        $this->assertEquals($vote->id, $response->json()['id']);
    }
}       