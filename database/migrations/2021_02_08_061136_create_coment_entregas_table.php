<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentEntregasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coment_entregas', function (Blueprint $table) {
            $table->id();
            $table->string('mensaje');
            $table->unsignedBigInteger('identrega');
            $table->unsignedBigInteger('idmaestro');

            $table->foreign('identrega')->references('id')->on('entregas')->onDelete('cascade');
            $table->foreign('idmaestro')->references('id')->on('maestros')->onDelete('cascade');
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
        Schema::dropIfExists('coment_entregas');
    }
}
