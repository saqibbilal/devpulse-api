<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'description', 'thumbnail_url', 'tech_stack', 'order', 'is_featured'];

    protected $casts = [
        'tech_stack' => 'array',
        'is_featured' => 'boolean', // RULE: Always cast booleans for clean JSON API responses
        'order' => 'integer',       // Optional, but good for strict typing
    ];

    public function detail() {
        return $this->hasOne(ProjectDetail::class);
    }

    protected function thumbnailUrl(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                // RULE: If it's already a full URL (like from our Factory), return it
                if (filter_var($value, FILTER_VALIDATE_URL)) {
                    return $value;
                }

                // Otherwise, build the full URL from the storage path
                return $value ? Storage::disk('public')->url($value) : null;
            }
        );
    }
}
