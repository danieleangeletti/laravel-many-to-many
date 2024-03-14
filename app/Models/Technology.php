<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug'
    ];
    protected $hidden = [
        'id',
    ];

    // Relationships
    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}
