<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'type_id',
        'cover_img'
    ];

    protected $hidden = [
        'id',
        'type_id'
    ];

    protected $appends = [
        'full_cover_img'
    ];

    // full_cover_img
    public function getFullCoverImgAttribute()
    {
        if ($this->cover_img) {
            return asset('/storage/' . $this->cover_img);
        } else {
            return null;
        }
    }

    // Relationships
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }
}
