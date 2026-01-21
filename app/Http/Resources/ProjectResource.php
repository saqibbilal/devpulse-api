<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'slug' => $this->slug,
            'description' => $this->description,
            'thumbnail_url' => $this->thumbnail_url,
            // Ensure tech_stack is always an array for the React .map()
            'tech_stack' => is_array($this->tech_stack)
                ? $this->tech_stack
                : json_decode($this->tech_stack, true) ?? [],
            'created_at' => $this->created_at->format('Y-m-d'),
        ];
    }
}
