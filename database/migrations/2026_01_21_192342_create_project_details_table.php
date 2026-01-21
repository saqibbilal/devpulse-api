<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('project_details', function (Blueprint $table) {
            $table->id();
            // unique() ensures it stays a strict One-to-One relationship
            $table->foreignId('project_id')->unique()->constrained()->onDelete('cascade');

            // Technical Story
            $table->longText('problem_statement')->nullable();
            $table->longText('solution_approach')->nullable();

            // Postgres JSONB power for decoupled repos
            $table->jsonb('repository_links')->nullable();
            // For the Feature list: ["Auth", "AWS SDK", "Redis Cache"]
            $table->jsonb('feature_highlights')->nullable();

            $table->string('live_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_details');
    }
};
