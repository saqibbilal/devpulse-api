<?php

namespace App\Observers;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;

class MediaObserver
{
    /**
     * Handle the Media "saved" event.
     */
    public function saved(Media $media): void
    {
        if ($media->model_type === Project::class && $media->collection_name === 'gallery') {
            $isFeatured = $media->getCustomProperty('is_featured', false);

            if ($isFeatured) {
                // Exclusive logic: if this one is featured, unset others for this specific project
                $media->model->getMedia('gallery')
                    ->where('id', '!==', $media->id)
                    ->each(function ($otherMedia) {
                        if ($otherMedia->getCustomProperty('is_featured')) {
                            $otherMedia->setCustomProperty('is_featured', false);
                            $otherMedia->saveQuietly();
                        }
                    });
            }

            $this->syncProjectThumbnail($media->model);
        }
    }

    /**
     * Handle the Media "deleted" event.
     */
    public function deleted(Media $media): void
    {
        if ($media->model_type === Project::class && $media->collection_name === 'gallery') {
            $this->syncProjectThumbnail($media->model);
        }
    }

    /**
     * Sync the project's thumbnail_url based on the featured media or first gallery item.
     */
    protected function syncProjectThumbnail(Project $project): void
    {
        // Rule: Search for the featured image first. 
        // Spatie media is already ordered by order_column by default.
        $featuredMedia = $project->getMedia('gallery')->first(function ($media) {
            return $media->getCustomProperty('is_featured', false);
        });

        // Fallback: If no image is marked as featured, use the first one in the collection
        $targetMedia = $featuredMedia ?? $project->getMedia('gallery')->first();

        if ($targetMedia) {
            // We store the path relative to the disk root so Storage::disk('s3')->url() works
            $project->thumbnail_url = $targetMedia->id . '/' . $targetMedia->file_name;
        } else {
            // Keep existing if no media, or clear if you want strict mirror
             // Let's clear it if the gallery is empty to maintain integrity
            $project->thumbnail_url = null;
        }

        $project->saveQuietly();
    }
}
