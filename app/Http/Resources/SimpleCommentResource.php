<?php

namespace App\Http\Resources;

use App\Models\Vote;
use Illuminate\Http\Resources\Json\JsonResource;

class SimpleCommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $requestUserVote = Vote::where('creator_user_id', $request->user()?->id)
            ->where('votable_id', $this->id)
            ->where('votable_type', 'App\Models\Comment')
            ->first();
        return [
            'id' => $this->id,
            'creator' => new SimpleUserResource($this->creator),
            'parent' => $this->parent,
            'recieved_votes' => $this->sumVoteScore(),
            'my_vote' => $requestUserVote ? $requestUserVote->direction : null,
            'message' => $this->message,
        ];
    }
}
