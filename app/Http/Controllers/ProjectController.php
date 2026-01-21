<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // We sort by 'order' so you can pick which project shows first on your CV
        $projects = Project::where('is_featured', true)
            ->orderBy('order', 'asc')
            ->get();
        return ProjectResource::collection($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        // We search by 'slug' instead of 'id' to match your Next.js dynamic route
        // firstOrFail() automatically returns a 404 if the project isn't found
        $project = Project::where('slug', $slug)->firstOrFail();

        return new ProjectResource($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
