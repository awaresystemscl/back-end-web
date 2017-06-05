<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelacionApiCat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relacion_api_cat', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ponderacion');
            //foraneas
            $table->integer('api_id')->unsigned();
            $table->foreign('api_id')->references('id')->on('apis');
            $table->integer('categoria_id')->unsigned();
            $table->foreign('categoria_id')->references('id')->on('categorias');
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
        Schema::dropIfExists('relacion_api_cat');
    }
}
//lineas 9