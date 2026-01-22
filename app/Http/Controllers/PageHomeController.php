<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Promotion;
use App\Models\News;

class PageHomeController extends Controller
{
    public function index() {
        $nowShowing = DB::table('moviex')->where('date', '<=', now())->limit(4)->get();
        $comingSoon = DB::table('moviex')->where('date', '>', now())->limit(4)->get();
        $promotions = Promotion::limit(8)->get();
        $news = News::limit(8)->get();

        return view('homes', compact('nowShowing', 'comingSoon', 'promotions', 'news'));
    }
}
