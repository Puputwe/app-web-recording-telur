<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePopulasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('populasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kandang');
            $table->string('kd_ayam', 25)->unique();
            $table->date('tgl_tetas');
            $table->string('status_aym', 25);
            $table->timestamps();

            $table->foreign('id_kandang')->references('id')->on('kandang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('populasi');
    }
}
