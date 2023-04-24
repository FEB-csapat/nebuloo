<?php

namespace App\Http\Resources;

use App\Models\Vote;
use Carbon\Carbon;
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
        $requestUserVote = Vote::where('owner_user_id', $request->user()?->id)
            ->where('votable_id', $this->id)
            ->where('votable_type', 'App\Models\Question')
            ->first();
        return [
            'id' => $this->id,
            'subject' => new SubjectResource($this->subject),
            'topic' => new TopicResource($this->topic),
            'creator' => new SimpleUserResource($this->creator),
            'recieved_votes' => $this->sumVoteScore(),
            'my_vote' => $requestUserVote ? $requestUserVote->direction : null,
            'comments' => CommentResource::collection($this->comments),
            'title' => $this->title,
            'body' => $this->body,
            'created_at' => Carbon::parse($this->created_at)->format('Y.m.d H:i'),
            'updated_at' => Carbon::parse($this->updated_at)->format('Y.m.d H:i'),
        ];
    }
}
