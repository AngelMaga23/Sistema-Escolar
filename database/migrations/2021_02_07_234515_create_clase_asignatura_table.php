<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaseAsignaturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clase_asignatura', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idclase');
            $table->unsignedBigInteger('idmaestro');
            $table->unsignedBigInteger('idasignatura');

            $table->foreign('idclase')->references('id')->on('clases')->onDelete('cascade');
            $table->foreign('idmaestro')->references('id')->on('maestros')->onDelete('cascade');
            $table->foreign('idasignatura')->references('id')->on('asignaturas')->onDelete('cascade');

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
        Schema::dropIfExists('clase_asignatura');
    }
}
