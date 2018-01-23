<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SatisfaccionComponente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('satisfaccion_componente', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('satisfaccion');
            //foranea
            $table->integer('componente_id')->unsigned();
            $table->foreign('componente_id')->references('id')->on('componentes');
            $table->integer('factor_id')->unsigned();
            $table->foreign('factor_id')->references('id')->on('factores');
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
        Schema::dropIfExists('satisfaccion_componente');
    }
}
