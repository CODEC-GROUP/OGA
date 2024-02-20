<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'image_url' => json_decode($this->image_url),
            'type' => $this->type,
            'statistics' => json_decode($this->statistics),
            'event_date' => $this->event_date,
            'event_time' => $this->event_time,
            'projectCategories' => $this->projectCategories
        ];
    }
}
