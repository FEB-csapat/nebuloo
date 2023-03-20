<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Content;
use App\Models\Question;
use App\Models\Comment;

class VoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // this is probablly a bad idea
        /*
        $votable = null;
        switch ($this->votable_type) {
            case 'content':
                $votable = new ContentResource(Content::find($this->votable_id));
                break;
            case 'question':
                $votable = new QuestionResource(Question::find($this->votable_id));
                break;
            case 'comment':
                $votable = new CommentResource(Comment::find($this->votable_id));
                break;
            
            default:
                // some sort of error happened
                break;
        }
        */

        return [
            'id' => $this->id,
            'owner' => $this->owner_user_id,
            'granted' => $this->granted_user_id,
            'votable_type' => $this->votable_type,
           // 'votable' => $votable,
            'votable_id' => $this->votable_id,
            'direction' => $this->direction,
        ];
    }
}
