<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'creator' => UserResource::collection($this->creator),
           // this should be done by conditional attributes...
           // 'content' => VoteResource::collection($this->votes)//->when(),
           // 'question' => CommentResource::collection($this->comments),
            'parent' => $this->parent,
            'message' => $this->message
        ];
    }
}
