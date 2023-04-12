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
            
           // 'votable_id' => $this->votable_id,
            'direction' => $this->direction,
        ];
    }
}
