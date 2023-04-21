<?php

namespace App\Http\Resources;

use App\Models\Vote;
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
        $requestUserVote = Vote::where('owner_user_id', $request->user()?->id)
            ->where('votable_id', $this->id)
            ->where('votable_type', 'App\Models\Comment')
            ->first();
        return [
            'id' => $this->id,
            'creator' => new SimpleUserResource($this->creator),
            'parent' => $this->parent,
            'message' => $this->message,
            'recieved_votes' => $this->sumVoteScore(),
            'my_vote' => $requestUserVote ? $requestUserVote->direction : null,
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
