<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stok', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pakan');
            $table->decimal('jml_pakan', 8,2);
            $table->date('tgl_masuk');
            $table->timestamps();

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
        Schema::dropIfExists('stok');
    }
}
