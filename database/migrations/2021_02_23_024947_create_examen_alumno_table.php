<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamenAlumnoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examen_alumno', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idexamen');
            $table->unsignedBigInteger('idalumnoclase');
            $table->float('puntos',8,2);
            $table->string('restante');

            $table->foreign('idexamen')->references('id')->on('examens')->onDelete('cascade');
            $table->foreign('idalumnoclase')->references('id')->on('alumno_clase')->onDelete('cascade');
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
        Schema::dropIfExists('examen_alumno');
    }
}
