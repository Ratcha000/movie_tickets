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
        Schema::create('afterdis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orderticketid')->constrained('orderticket')->onDelete('cascade'); // เชื่อมกับตาราง orderticket
            $table->decimal('afprice',8 ,2);  // ราคาหลังจากลด
            $table->decimal('lodprice', 8, 2);  // ราคาลด
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('afterdis');
    }
};
