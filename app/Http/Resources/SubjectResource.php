<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
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
            'creator_user_id' => $this->creator_user_id,
            'name' => $this->name,
            'topics' => TopicResource::collection($this->topics),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
