<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
