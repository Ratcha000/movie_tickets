<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderTicket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    public function showPaymentPage(){
    // ข้อมูลป๊อปคอร์นและเครื่องดื่ม
    $pnds = [
        ['name' => 'ป๊อปคอร์นรสคลาสสิค', 'price' => 45, 'image' => 'images/pnd/p1.png'],
        ['name' => 'ป๊อปคอร์นรสชีส', 'price' => 45, 'image' => 'images/pnd/p2.png'],
        ['name' => 'ป๊อปคอร์นรสข้าวโพดปิ้ง', 'price' => 45, 'image' => 'images/pnd/p3.png'],
        ['name' => 'ป๊อปคอร์นรส Strawberry velvet', 'price' => 45, 'image' => 'images/pnd/p4.png'],
        ['name' => 'น้ำเปล่า', 'price' => 10, 'image' => 'images/pnd/d1.png'],
        ['name' => 'น้ำอัดลม', 'price' => 20, 'image' => 'images/pnd/d2.png'],
        ['name' => 'น้ำส้ม', 'price' => 20, 'image' => 'images/pnd/d3.png'],
        ['name' => 'น้ำใจเย็น', 'price' => 25, 'image' => 'images/pnd/d4.png']
    ];

    // Retrieve movie and ticket details from the session
    $selectedMovie = session('selected_movie');
    $selectedTickets = session('selected_tickets');
    $totalPrice = session('total_price');

    return view('jame/payment', compact('pnds','selectedMovie', 'selectedTickets', 'totalPrice'));
    }

    public function submitPayment(Request $request)
{
    // ตรวจสอบว่าผู้ใช้ได้เข้าสู่ระบบหรือไม่
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Please login before making a payment.');
    }


    // รับข้อมูลจาก session (หรือตัวแปรอื่น ๆ)
    $selectedMovie = session('selected_movie');
    $selectedTickets = session('selected_tickets');
    $totalPrice = session('total_price');


    // บันทึกข้อมูลการจองลงในฐานข้อมูล
    $orderTicket = OrderTicket::create([
        'user_id' => Auth::id(), // เพิ่ม user_id จากผู้ใช้ที่เข้าสู่ระบบ
        'tickets' => implode(', ', $selectedTickets), // แปลง array ที่นั่งเป็น string
        'total_price' => $totalPrice,
        'is_booked' => true, // กำหนดสถานะว่า "จองแล้ว"
        'movie_id' => $selectedMovie->id, // ใช้ movieId จาก session
    ]);

    // รับข้อมูลจากฟอร์ม
    $popcornSummary = $request->input('popcornSummary');
    $pricepopcornSummary = $request->input('pricepopcornSummary');

    // บันทึกข้อมูลป๊อปคอร์นลงในฐานข้อมูล
    // ตรวจสอบว่ามีการส่งค่ามาหรือไม่ก่อนทำการ insert
    if (!empty($popcornSummary) || !empty($pricepopcornSummary)) {
        DB::table('orderpnd')->insert([
            'orderticketid' => $orderTicket->id,
            'p_n_d' => $popcornSummary,  // รายการป๊อปคอร์น
            'price' => $pricepopcornSummary // ราคารวมทั้งหมด
        ]);
    }

    // รับค่า finalPrice และ discountAmount จากฟอร์ม
    $finalPrice = $request->input('final_price'); // จากฟอร์ม
    $discountAmount = $request->input('discount_amount'); // จากฟอร์ม

    // ตรวจสอบว่ามีส่วนลดหรือไม่ ถ้ามีให้บันทึกลงฐานข้อมูลในตาราง afterdis
    if (!empty($finalPrice) && !empty($discountAmount)) {
        DB::table('afterdis')->insert([
            'orderticketid' => $orderTicket->id,
            'afprice' => $finalPrice,  // ราคาหลังจากลด
            'lodprice' => $discountAmount, // ราคาลด
        ]);
    }

    // เปลี่ยนเส้นทางไปยังหน้าชำระเงินสำเร็จ
    return view('jame/paymentsuccess', [
        'selectedMovie' => $selectedMovie,
        'selectedTickets' => $selectedTickets,
        'totalPrice' => $totalPrice,
        'popcornSummary' => $popcornSummary,
        'pricepopcornSummary' => $pricepopcornSummary,
        'finalPrice' => $finalPrice,
        'discountAmount' => $discountAmount
    ]);
}

public function success() {
    // ดึงข้อมูลที่จำเป็นจาก session
    $selectedMovie = session('selected_movie');
    $selectedTickets = session('selected_tickets');
    $totalPrice = session('total_price');
    $popcornSummary = session('popcornSummary');
    $pricepopcornSummary = session('pricepopcornSummary');
    $finalPrice = session('final_price');
    $discountAmount = session('discount_amount');

    return view('jame/paymentsuccess', compact(
        'selectedMovie', 
        'selectedTickets', 
        'totalPrice', 
        'popcornSummary', 
        'pricepopcornSummary', 
        'finalPrice', 
        'discountAmount'
    ));
}


    public function applyDiscount(Request $request)
{
    // รับค่าจากฟอร์ม
    $discountCode = $request->input('discountCode');
    
    // ค้นหาโค้ดส่วนลดจากฐานข้อมูล
    $promotion = DB::table('promotion')
        ->where('code', $discountCode)
        ->where('is_active', 1) // ตรวจสอบว่าโค้ดส่วนลดนี้ยังใช้ได้อยู่
        ->first();
    
    // ถ้าเจอโค้ดส่วนลด
    if ($promotion) {
        $discountPercentage = $promotion->discount_percentage;
        return response()->json([
            'success' => true,
            'discount' => $discountPercentage,
            'message' => 'โค้ดส่วนลดถูกต้อง!'
        ]);
    } else {
        // ถ้าไม่เจอโค้ดส่วนลด
        return response()->json([
            'success' => false,
            'message' => 'โค้ดส่วนลดไม่ถูกต้อง หรือไม่มีโค้ดนี้'
        ]);
    }
}


}