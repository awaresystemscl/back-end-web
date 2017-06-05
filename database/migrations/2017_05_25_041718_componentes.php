<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Componentes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('componentes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion');
            $table->string('categoria');
            $table->string('url');
            //foranea
            $table->integer('api_id')->unsigned();
            $table->foreign('api_id')->references('id')->on('apis');
            $table->integer('mashup_id')->unsigned();
            $table->foreign('mashup_id')->references('id')->on('mashups');
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
        Schema::dropIfExists('componentes');
        
    }
}
//lineas 11