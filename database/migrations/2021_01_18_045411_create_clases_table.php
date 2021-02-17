<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clases', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            // $table->unsignedBigInteger('idasigmaestro');
            $table->unsignedBigInteger('idgrupo');

            // $table->foreign('idasigmaestro')->references('id')->on('asign_maestro')->onDelete('cascade');
            $table->foreign('idgrupo')->references('id')->on('grupos')->onDelete('cascade');

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
        Schema::dropIfExists('clases');
    }
}
