<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['title', 'director', 'release_date', 'genre', 'rating'];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    use HasFactory;
    public function comments()
{
    return $this->hasMany(Comment::class);
}
}
