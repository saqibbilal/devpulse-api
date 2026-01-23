<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Don't forget this import!
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory; // Rule: Always include this for testability

    protected $fillable = [
        'name',
        'category',
        'order'
    ]; // Rule: Protect your DB from malicious mass-assignment
}
