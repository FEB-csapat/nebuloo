<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
            'display_name' => $this->display_name,
            'bio' => $this->bio,

            'role' => $this->getRoleNames()[0],

            'avatar' => $this->provider?->avatar,
            
            'comments' => CommentResource::collection($this->comments),
            'contents' => SimpleContentResource::collection($this->contents),
            'questions' => QuestionResource::collection($this->questions),
            'tickets' => TicketResource::collection($this->tickets),
            'recieved_votes' => $this->sumVoteScore(),
            'rank'=>$this->getRank(),
            
            'created_at' => Carbon::parse($this->created_at)->format('Y.m.d H:i'),
            'updated_at' => Carbon::parse($this->updated_at)->format('Y.m.d H:i'),
        ];
    }
}
