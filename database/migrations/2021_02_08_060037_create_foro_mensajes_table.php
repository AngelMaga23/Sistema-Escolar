<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForoMensajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foro_mensajes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idforo');
            $table->string('mensaje');
            $table->string('mensajeable_type');
            $table->unsignedBigInteger('idalumno_clase');

            $table->foreign('idalumno_clase')->references('id')->on('alumno_clase')->onDelete('cascade');
            $table->foreign('idforo')->references('id')->on('foros')->onDelete('cascade');
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
        Schema::dropIfExists('foro_mensajes');
    }
}
