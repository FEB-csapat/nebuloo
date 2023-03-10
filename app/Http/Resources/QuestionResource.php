<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            'creator' => new UserResource($this->creator),
            'votes' => VoteResource::collection($this->votes),
            'comments' => CommentResource::collection($this->comments),
            'title' => $this->title,
            'body' => $this->body
        ];
    }
}
