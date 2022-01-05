<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class News extends JsonResource
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
            'topics_id' => $this->topics_id,
            'topic' => $this->topics->topic,
            'title' => $this->title,
            'content' => $this->content,
            'status' => $this->status,
            'tags' => $this->tags,
            'created_at' => $this->created_at,
            'update_at' => $this->updated_at
        ];
    }
}
