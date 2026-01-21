<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectDetail extends Model
{
    // 1. Mass Assignment Protection



    protected $fillable = ['project_id', 'problem_statement', 'solution_approach', 'repository_links', 'feature_highlights', 'live_url'];
    protected $casts = [
        'repository_links' => 'array',
        'feature_highlights' => 'array'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
