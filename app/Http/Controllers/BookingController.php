<?php



namespace App\Http\Controllers;

use App\Models\OrderTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index($id)
    {
        // ดึงที่นั่งที่ถูกจองสำหรับหนังเรื่องนี้เท่านั้น
        $orderTickets = OrderTicket::where('movie_id', $id)
                                ->where('is_booked', true)
                                ->get();
        $bookedSeats = [];

        foreach ($orderTickets as $order) {
            $seats = explode(', ', $order->tickets);
            $bookedSeats = array_merge($bookedSeats, $seats);
        }

        $movie = DB::table('moviex')->where('id', $id)->first();
    
   
    if (!$movie) {
        return redirect()->back()->with('error', 'Movie not found.');
    }

        return view('booking', ['bookedSeats' => $bookedSeats, 'movie' => $movie]);
    }

    public function store(Request $request) {
        $tickets = $request->input('ticket', []);
        $totalPrice = $request->input('total_price', 0);
    
        // รับค่า movie_id จากฟอร์ม
        $selectedMovieId = $request->input('movie_id');
    
        // เก็บข้อมูลลง session
        session([
            'selected_movie' => DB::table('moviex')->where('id', $selectedMovieId)->first(),
            'selected_tickets' => $tickets,
            'total_price' => $totalPrice,
            'movie_id' => $selectedMovieId // เก็บ movie_id ลงใน session
        ]);
    
        return redirect()->route('payment');
    }
}

