<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EstadisticaCuartil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estadistica_cuartil', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nivel_factor');
            $table->integer('minimo');
            $table->integer('medio');
            $table->integer('maximo');
            $table->string('categoria'); //esta cosa hay que cambiarla en algun momento
            //foranea
            $table->integer('factor_id')->unsigned();
            $table->foreign('factor_id')->references('id')->on('factores');
            $table->timestamp('fecha');
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
        Schema::dropIfExists('estadistica_cuartil');
    }
}
