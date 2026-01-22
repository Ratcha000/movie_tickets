<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\OrderTicket;

use Illuminate\Http\Request;

class AdimController extends Controller
{
    //
    public function index($id)
{
    // ดึงข้อมูลภาพยนตร์ตาม ID ที่ส่งมา
    $movie = DB::table('moviex')->where('id', $id)->first();

    // ตรวจสอบว่ามีข้อมูลภาพยนตร์หรือไม่
    if (!$movie) {
        return redirect()->back()->with('error', 'ไม่พบข้อมูลภาพยนตร์');
    }

    // ดึงข้อมูล orderticket ที่เชื่อมโยงกับภาพยนตร์นี้ (ใช้ movie_id ในการเชื่อมโยง)
    $orderticket = DB::table('orderticket')->where('movie_id', $id)->get();

    // ตรวจสอบว่ามีข้อมูล orderticket หรือไม่
    if ($orderticket->isEmpty()) {
        return view('AdminView', [
            'movie' => $movie,
            'orderticket' => collect([]), // ส่งข้อมูลว่างไปยัง view
            'pnd' => collect([]), // ส่งข้อมูลว่างไปยัง view
            'totalPrice' => 0
        ]);
    }

    // ดึงข้อมูล orderpnd ที่เกี่ยวข้องกับ orderticket
    $pnd = DB::table('orderpnd')
             ->whereIn('orderticketid', $orderticket->pluck('id')) 
             ->get();

    $dis = DB::table('afterdis')
    ->whereIn('orderticketid', $orderticket->pluck('id')) 
    ->get();

    // ส่งข้อมูลไปยัง view
    return view('AdminView', [
        'movie' => $movie,
        'orderticket' => $orderticket,
        'pnd' => $pnd,
        'totalPrice' => 0,// เริ่มต้นค่า totalPrice เป็น 0
        'dis' => $dis,
        
    ]);
}


    public function delete($lec_id)
    {
        $lecturer = OrderTicket::findOrFail($lec_id);
        $lecturer->delete();

        return redirect('HomeAdmin');
    }

    

}
