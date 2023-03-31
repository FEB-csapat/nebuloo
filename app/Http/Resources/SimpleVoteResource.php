<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Content;
use App\Models\Question;
use App\Models\Comment;

class SimpleVoteResource extends JsonResource
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
            'votable_type' => $this->votable_type,
            'votable_id' => $this->votable_id,
            'direction' => $this->direction,
        ];
    }
}
