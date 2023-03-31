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
        

        return [
            'id' => $this->id,
            'owner' => new SimpleUserResource($this->owner),
            'reciever' => new SimpleUserResource($this->reciever),
            'votable_type' => $this->votable_type,
            'votable' => $this->votable,
            /*
            'votable' => $this->whenLoaded('votable', function () {
                if($this->votable_type == 'App\Models\Content'){
                    return new SimpleContentResource($this->votable);
                }else if($this->votable_type == 'App\Models\Question'){
                    return new SimpleQuestionResource($this->votable);
                }else if($this->votable_type == 'App\Models\Comment'){
                    return new SimpleCommentResource($this->votable);
                }else{
                    abort(500, 'Voteable type not found');
                }
            }),
            */
           // 'votable_id' => $this->votable_id,
            'direction' => $this->direction,
        ];
    }
}
