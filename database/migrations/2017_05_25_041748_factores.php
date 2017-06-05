<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Factores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('rango');
            $table->string('medida');
            $table->enum('tipo_de_medida',['mayor','menor'])->default('mayor');
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
        Schema::dropIfExists('factores');
    }
}
//lineas 8