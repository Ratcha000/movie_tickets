<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\News;

class PageNewsController extends Controller
{
    public function index(){
        $all = News::all();
        $news = News::where('category', '=', "News & Activities")->get();
        $movie = News::where('category', '=', "Movie News")->get();

        return view('news.index', compact('all', 'news', 'movie'));
    }

    public function show($id){
        $news = News::find($id);
        return view('news.show', compact('news'));
    }
}
