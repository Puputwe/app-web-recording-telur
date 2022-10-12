<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePakanMasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pakan_masuk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pakan');
            $table->decimal('jml_pakan');
            $table->date('tgl_masuk');
            $table->timestamps();

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
        Schema::dropIfExists('pakan_masuk');
    }
}
