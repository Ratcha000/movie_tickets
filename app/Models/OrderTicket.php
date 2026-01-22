<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTicket extends Model
{


    use HasFactory;

    protected $table = 'orderticket';

    protected $fillable =['user_id', 'movie_id','tickets','total_price','booking_date','is_booked','image_path',];
}
