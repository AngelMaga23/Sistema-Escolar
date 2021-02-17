<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnoRespuestaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumno_respuesta', function (Blueprint $table) {
            // $table->id();
            $table->unsignedBigInteger('idalumnoclase');
            $table->unsignedBigInteger('idrespuesta');

            $table->primary(['idalumnoclase','idrespuesta']);
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
        Schema::dropIfExists('alumno_respuesta');
    }
}
