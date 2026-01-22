<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Movie;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $movieId)
    {
        $movie = Movie::findOrFail($movieId);

        $validatedData = $request->validate([
            'reviewer_name' => 'required|string|max:255',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $movie->comments()->create($validatedData);

        return redirect()->back()->with('success', 'Comment submitted successfully!');
    }
}