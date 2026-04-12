<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Project extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['title', 'slug', 'description', 'thumbnail_url', 'tech_stack', 'order', 'is_featured'];

    protected $casts = [
        'tech_stack' => 'array',
        'is_featured' => 'boolean', // RULE: Always cast booleans for clean JSON API responses
        'order' => 'integer',       // Optional, but good for strict typing
    ];

    public function detail() {
        return $this->hasOne(ProjectDetail::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('gallery')
            ->useDisk('s3');
    }


    protected function thumbnailUrl(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                // RULE: If it's already a full URL (like from our Factory), return it
                if (filter_var($value, FILTER_VALIDATE_URL)) {
                    return $value;
                }

                // If no direct thumbnail_url is set, we could potentially return the featured image from media
                // But for now, we keep the existing logic and let the Observer handle the sync.
                return $value ? Storage::disk('s3')->url($value) : null;
            }
        );
    }
}
