<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    // แสดงหน้าสำหรับแก้ไขหนัง
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);  // หา movie ตาม id
        return view('movies.create', compact('movie'));  // ส่ง $movie ไปที่ view
    }

    // แสดงรายชื่อหนังทั้งหมด
    public function index()
    {
        $movies = Movie::all();
        return view('movies.index', compact('movies'));
    }

    // แสดงรายละเอียดของหนังแต่ละเรื่อง
    public function show($id)
    {
        $movie = Movie::with('reviews')->find($id);
        
        if (!$movie) {
            return redirect('/')->with('error', 'Movie not found.');
        }

        return view('movies.show', compact('movie'));
    }

    // บันทึกรีวิวของหนัง
    public function storeReview(Request $request, $id)
    {
        $request->validate([
            'reviewer_name' => 'required',
            'review' => 'required',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Review::create([
            'movie_id' => $id,
            'reviewer_name' => $request->input('reviewer_name'),
            'review' => $request->input('review'),
            'rating' => $request->input('rating'),
        ]);

        return redirect()->back()->with('success', 'Review added successfully!');
    }

    // แสดงฟอร์มสำหรับสร้างหนังใหม่
    public function create()
    {
        return view('movies.create');
    }

    // บันทึกข้อมูลหนังใหม่ลงในฐานข้อมูล

public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'director' => 'required',
        'release_date' => 'required|date',
        'genre' => 'required',
        'rating' => 'required|numeric|min:1|max:10',
        'poster' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // ตรวจสอบประเภทไฟล์และขนาด
    ]);

    // จัดการอัปโหลดไฟล์
    if ($request->hasFile('poster')) {
        $posterPath = $request->file('poster')->store('posters', 'public');
    }

    $movie = new Movie();
    $movie->title = $request->title;
    $movie->director = $request->director;
    $movie->release_date = $request->release_date;
    $movie->genre = $request->genre;
    $movie->rating = $request->rating;
    $movie->poster = $posterPath ?? null;  // บันทึก path ของรูปภาพ
    $movie->save();

    return redirect('/movies');
}
public function destroy($id)
{
    $movie = Movie::findOrFail($id);
    
    // ลบหนัง
    $movie->delete();

    // ส่งกลับไปที่หน้าหลักพร้อมข้อความแสดงความสำเร็จ
    return redirect()->route('movies.index')->with('success', 'Movie deleted successfully');
}

    // แสดงหน้าสำหรับยืนยันการลบหนัง
    public function delete($id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.delete', compact('movie'));
    }

    // อัปเดตข้อมูลหนัง
    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        // ตรวจสอบข้อมูลที่ส่งมา
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'director' => 'required|string|max:255',
            'release_date' => 'required|date',
            'genre' => 'required|string|max:255',
            'rating' => 'required|numeric|min:1|max:10',
            'poster_url' => 'required|url', // ใช้ URL แทนการอัปโหลดไฟล์
        ]);

        // อัปเดตข้อมูลหนัง
        $movie->update($validatedData);

        return redirect()->route('movies.show', $movie->id)->with('success', 'Movie updated successfully!');
    }
}