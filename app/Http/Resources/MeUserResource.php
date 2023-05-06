<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MeUserResource extends JsonResource
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
            'username' => $this->username,
            'display_name' => $this->display_name,
            'bio' => $this->bio,
            'role' => $this->role,
            'contents' => SimpleContentResource::collection($this->contents),
            'questions' => SimpleQuestionResource::collection($this->questions),
            'comments' => SimpleCommentResource::collection($this->comments),
            'tickets' => TicketResource::collection($this->tickets),
            'recieved_votes' => $this->sumVoteScore(),
            'rank'=>$this->getRank(),
            'banned'=>$this->banned,
            'notify_by_email'=>$this->notify_by_email,
            'created_at' => Carbon::parse($this->created_at)->format('Y.m.d H:i'),
            'updated_at' => Carbon::parse($this->updated_at)->format('Y.m.d H:i'),
        ];
    }
}
