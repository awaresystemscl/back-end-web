<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelacionComFac extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relacion_com_fac', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nivel');
            $table->integer('posicion');
            $table->boolean('tendencia')->default(false);
            $table->boolean('union')->default(false);
            //foraneas
            $table->integer('componente_id')->unsigned();
            $table->foreign('componente_id')->references('id')->on('componentes');
            $table->integer('factor_id')->unsigned();
            $table->foreign('factor_id')->references('id')->on('factores');
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
        Schema::dropIfExists('relacion_com_fac');
        
    }
}
//lineas 12