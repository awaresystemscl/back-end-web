<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConjuntoSatisfaccionMashup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conjunto_satisfaccion_mashup', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('avg');
            //foranea
            $table->integer('usuario_id')->unsigned();
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->integer('mashup_id')->unsigned();
            $table->foreign('mashup_id')->references('id')->on('mashups');
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
        Schema::dropIfExists('conjunto_satisfaccion_mashup');
    }
}
