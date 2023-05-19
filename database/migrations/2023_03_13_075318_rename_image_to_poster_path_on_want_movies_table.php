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
        Schema::table('want_movies', function (Blueprint $table) {
            // $table->renameColumn('image', 'poster_path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('want_movies', function (Blueprint $table) {
            // $table->renameColumn('poster_path', 'image');
        });
    }
};
