<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntregasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entregas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('archivo')->nullable();
            $table->string('descripcion');
            $table->float('calificacion',8,2);
            $table->enum('estatu',['1','0']);
            $table->unsignedBigInteger('idalumno_clase');
            $table->unsignedBigInteger('idtarea');

            $table->foreign('idalumno_clase')->references('id')->on('alumno_clase')->onDelete('cascade');
            $table->foreign('idtarea')->references('id')->on('tareas')->onDelete('cascade');
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
        Schema::dropIfExists('entregas');
    }
}
