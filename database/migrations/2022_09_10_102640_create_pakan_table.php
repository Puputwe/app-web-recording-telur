<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePakanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pakan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_jenis_pakan');
            $table->string('nama', 25)->unique();
            $table->string('perusahaan', 25);
            $table->decimal('stok', 8,2);
            $table->text('keterangan')->null();
            $table->timestamps();

            $table->foreign('id_jenis_pakan')->references('id')->on('jenis_pakan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pakan');
    }
}
