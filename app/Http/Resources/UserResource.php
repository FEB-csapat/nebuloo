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
            'name' => $this->name,
            'bio' => $this->bio,
            'registration_date' => $this->registration_date,
            'rank' => RankResource::collection($this->rank),
          //  'votes' => VoteResource::collection($this->votes),
            'comments' => CommentResource::collection($this->comments),
            'contents' => ContentResource::collection($this->contents),
            'questions' => QuestionResource::collection($this->questions),
        ];
    }
}
