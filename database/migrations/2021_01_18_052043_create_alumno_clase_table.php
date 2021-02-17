<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnoClaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumno_clase', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idalumno');
            $table->unsignedBigInteger('idclase');

            $table->foreign('idalumno')->references('id')->on('alumnos')->onDelete('cascade');
            $table->foreign('idclase')->references('id')->on('clases')->onDelete('cascade');
            // $table->primary(['idalumno','idclase']);
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
        Schema::dropIfExists('alumno_clase');
    }
}
