<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ApisDataTest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apis_data_test', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->double('rendimiento');
            $table->double('latencia');
            $table->double('status');
            $table->double('tiempo_de_respuesta');
            $table->double('disponibilidad');
            $table->double('confiabilidad');
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
        Schema::dropIfExists('apis_data_test');
    }
}
