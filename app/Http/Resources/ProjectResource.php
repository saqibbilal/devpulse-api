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
            // Use 'whenLoaded' to only include details if we specifically asked for them
            // This keeps your Home Page API response small and fast!
            'detail' => $this->whenLoaded('detail', function() {
                return [
                    'id' => $this->detail->id,
                    'problem_statement' => $this->detail->problem_statement,
                    'solution_approach' => $this->detail->solution_approach,
                    'repository_links' => $this->detail->repository_links,
                    'feature_highlights' => $this->detail->feature_highlights,
                    'live_url' => $this->detail->live_url,
                    'gallery' => $this->getMedia('gallery')->map(function ($media) {
                        return [
                            'url' => $media->getUrl(),
                            'name' => $media->name,
                            'order' => $media->order_column,
                            'is_featured' => $media->getCustomProperty('is_featured', false),
                        ];
                    }),
                ];
            }),
        ];
    }
}
