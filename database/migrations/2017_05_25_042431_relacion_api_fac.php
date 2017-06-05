<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelacionApiFac extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relacion_api_fac', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->integer('valor');
            //foraneas
            $table->integer('api_id')->unsigned();
            $table->foreign('api_id')->references('id')->on('apis');
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
        Schema::dropIfExists('relacion_api_fac');
    }
}
//lineas 10