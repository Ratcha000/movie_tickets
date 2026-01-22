<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class PageMovieController extends Controller
{
    public function index() {
        $nowShowing = DB::table('moviex')->where('date', '<=', now())->get();
        $comingSoon = DB::table('moviex')->where('date', '>', now())->get();

        return view('movie', compact('nowShowing', 'comingSoon'));
    }
}
