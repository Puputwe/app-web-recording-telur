<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataRecordingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_recording', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_users');
            $table->foreignId('id_kandang');
            $table->foreignId('id_pakan');
            $table->date('tanggal');
            $table->integer('jml_telur');
            $table->decimal('berat_telur');
            $table->decimal('jml_pakan');
            $table->integer('ayam_hidup');
            $table->integer('ayam_afkir');
            $table->integer('ayam_mati');
            $table->decimal('hd');
            $table->decimal('fcr');
            $table->timestamps();

            $table->foreign('id_users')->references('id')->on('users');
            $table->foreign('id_kandang')->references('id')->on('kandang');
            $table->foreign('id_pakan')->references('id')->on('pakan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_recording');
    }
}
