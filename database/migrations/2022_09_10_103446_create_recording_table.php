<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recording', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_users');
            $table->foreignId('id_kandang');
            $table->foreignId('id_pakan');
            $table->date('tanggal');
            $table->integer('tot_telur');
            $table->decimal('berat_telur', 8,2);
            $table->decimal('tot_pakan', 8,2);
            $table->integer('ayam_hidup');
            $table->integer('ayam_afkir');
            $table->integer('ayam_mati');
            $table->decimal('hd', 8,2);
            $table->decimal('fcr', 8,2);
            $table->timestamps();

            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_kandang')->references('id')->on('kandang')->onDelete('cascade');
            $table->foreign('id_pakan')->references('id')->on('pakan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recording');
    }
}
