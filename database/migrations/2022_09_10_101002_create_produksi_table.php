<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kandang');
            $table->foreignId('id_populasi');
            $table->date('tgl_produksi')->current_timestamp();
            $table->integer('jml_telur');
            $table->text('keterangan')->null();
            $table->timestamps();

            $table->foreign('id_populasi')->references('id')->on('populasi')->onDelete('cascade');
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
        Schema::dropIfExists('produksi');
    }
}
