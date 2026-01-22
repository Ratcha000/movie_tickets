<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    //
    public function Stime($id)
{
    $movie = DB::table('moviex')->where('id', $id)->first();

    
    if (!$movie) {
        return redirect()->back()->with('error', 'Movie not found.');
    }

    return view('Timeset', ['movie' => $movie]);
}
}
