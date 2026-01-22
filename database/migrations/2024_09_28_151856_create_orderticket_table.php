<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orderticket', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_id')->constrained('moviex')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('tickets');
            $table->decimal('total_price',8,2);
            $table->timestamp('booking_date')->nullable();
            $table->boolean('is_booked')->default(false);
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderticket');
    }
};
