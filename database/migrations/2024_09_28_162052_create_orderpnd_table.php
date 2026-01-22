<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderpnd', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orderticketid')->constrained('orderticket')->onDelete('cascade'); // เชื่อมกับตาราง orderticket
            $table->string('p_n_d');  // ป๊อปดื่ม
            $table->decimal('price', 8, 2);  // ราคา
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orderpnd');
    }
};
