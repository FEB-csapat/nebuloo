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
            'creator' => new SimpleUserResource($this->creator),
            'parent' => $this->parent,
            'message' => $this->message,
            'recieved_votes' => $this->sumVoteScore(),
            'commentable_type' => $this->commentable_type,
            'commentable' => $this->whenLoaded('commentable', function () {
                if($this->commentable_type == 'App\Models\Content'){
                    return new SimpleContentResource($this->commentable);
                }else if($this->commentable_type == 'App\Models\Question'){
                    return new SimpleQuestionResource($this->commentable);
                }else{
                    abort(500, 'Commentable type not found');
                }
            }),
        ];
    }
}
