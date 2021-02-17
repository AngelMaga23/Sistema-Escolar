<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentsPublicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coments_publics', function (Blueprint $table) {
            $table->id();
            $table->string('comentario');
            $table->unsignedBigInteger('idalumno_clase');
            $table->unsignedBigInteger('idpublicacion');

            $table->foreign('idalumno_clase')->references('id')->on('alumno_clase')->onDelete('cascade');
            $table->foreign('idpublicacion')->references('id')->on('publicacions')->onDelete('cascade');
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
        Schema::dropIfExists('coments_publics');
    }
}
