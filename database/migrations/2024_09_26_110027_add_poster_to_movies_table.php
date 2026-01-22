<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPosterToMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Check if the 'poster' column already exists before adding
        if (!Schema::hasColumn('movies', 'poster')) {
            Schema::table('movies', function (Blueprint $table) {
                $table->string('poster')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Only drop the column if it exists
        if (Schema::hasColumn('movies', 'poster')) {
            Schema::table('movies', function (Blueprint $table) {
                $table->dropColumn('poster');
            });
        }
    }
}