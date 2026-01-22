<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{    protected $fillable = ['movie_id', 'reviewer_name', 'review', 'rating'];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
    use HasFactory;
}
