<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AMController extends Controller
{
    //
//ส่วนของ Home Admin
function index(){
    
    $movie = DB::table('moviex')->get();
    return view('HomeAdmin',compact('movie'));
}

function createForm(Request $request){

    $movie = DB::table('moviex')->get();
    $MovieEdit = null;
    // ตรวจสอบว่ามีการส่ง edit_id เข้ามาหรือไม่ เพื่อดึงข้อมูลสำหรับการแก้ไข
    if ($request->has('edit_id')) {
        $MovieEdit = DB::table('moviex')->where('id', $request->edit_id)->first();//
    }

    return view("Add_movie",compact('movie','MovieEdit'));
}
function insert(Request $request){
    $request->validate([
        'name' => 'required|string|max:255',
        'location' => 'required',
        'map' => 'required',
        'poster' => 'required|url',
        'date' => 'required',
        'time' => 'required',
    ]);

    DB::table('moviex')->insert([
        'name' => $request->name,
        'location' => $request->location,
        'map' => $request->map,
        'poster' => $request->poster, 
        'date' => $request->date,
        'time' => $request->time,
    ]);
    return redirect('/Add_movie')->with('success', 'Movie added successfully');
}

public function update(Request $request, $id)
{
    // ตรวจสอบความถูกต้องของข้อมูล
    $request->validate([
        'name' => 'required|string|max:50',
        'location' => 'required|max:50',
        'map' => 'required|max:50',
        'poster' => 'required|url|max:255',
        'date' => 'required',
        'time' => 'required',
    ]);

    // อัปเดตข้อมูล
    DB::table('moviex')->where('id', $id)->update([
        'name' => $request->name,
        'location' => $request->location,
        'map' => $request->map,
        'poster' => $request->poster, 
        'date' => $request->date,
        'time' => $request->time,
    ]);

    return redirect('/Add_movie')->with('success', 'Movie updated successfully');
}

public function updatedMovie(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'id' => 'required|integer|exists:moviex,id',
        'name' => 'required|string|max:50',
        'location' => 'required|max:50',
        'map' => 'required|max:50',
        'poster' => 'required|url|max:255',
        'date' => 'required',
        'time' => 'required',
    ]);
    DB::table('moviex')->where('id', $request->id)->update([
        'name' => $request->name,
        'location' => $request->location,
        'map' => $request->map,
        'poster' => $request->poster, 
        'date' => $request->date,
        'time' => $request->time,
    ]);

    return redirect('/HomeAdmin');
}

public function delete($id)
{
    $movie = DB::table('moviex')->where('id',$id) -> delete();

    return redirect('/HomeAdmin')->with('success', 'Movie updated successfully');
}
}