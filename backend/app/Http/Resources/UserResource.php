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

            'avatar' => $this->provider->avatar,
            'rank' => $this->rank,
            'comments' => CommentResource::collection($this->comments),
            'contents' => ContentResource::collection($this->contents),
            'questions' => QuestionResource::collection($this->questions),
            'votes' => VoteResource::collection($this->votes),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
