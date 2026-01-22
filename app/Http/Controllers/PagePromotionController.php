<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Promotion;

class PagePromotionController extends Controller
{
    public function index(){
        $promotions = Promotion::all();
        $Movies = Promotion::where('category', '=', "Movie")->get();
        $Foods = Promotion::where('category', '=', "Food & Beverage")->get();

        return view('promotions.index', compact('promotions', 'Movies', 'Foods'));
    }

    public function show($id){
        $promotion = Promotion::find($id);
        return view('promotions.show', compact('promotion'));
    }
}
