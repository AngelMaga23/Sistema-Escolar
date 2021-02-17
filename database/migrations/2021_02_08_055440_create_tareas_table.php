<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('archivo')->nullable();
            $table->enum('estatu',['1','0']);
            $table->dateTime('fecha_ini');
            $table->dateTime('fecha_fin');
            $table->unsignedBigInteger('idclase_asig');

            $table->foreign('idclase_asig')->references('id')->on('clase_asignatura')->onDelete('cascade');
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
        Schema::dropIfExists('tareas');
    }
}
