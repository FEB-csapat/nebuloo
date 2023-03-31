<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'bio' => $this->bio,

            'roles' => $this->getRoleNames(),

            'avatar' => $this->provider?->avatar,
            
            'rank' => new RankResource($this->rank),
            'comments' => CommentResource::collection($this->comments),
            'contents' => SimpleContentResource::collection($this->contents),
            'questions' => QuestionResource::collection($this->questions),

            'recieved_votes' => $this->recievedVotes->where('direction', 'up')->count()
                              - $this->recievedVotes->where('direction', 'down')->count(),
            'owned_votes' => SimpleVoteResource::collection($this->ownedVotes),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
