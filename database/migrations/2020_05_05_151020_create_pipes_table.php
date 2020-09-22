<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pipes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_status');
            $table->string('numero');
            $table->string('numero_economico');
            $table->string('capacidad');
            $table->string('compartimentos');
            $table->string('capacidad_compartimiento');
            $table->string('contenedor_disponible')->nullable();
            $table->unsignedBigInteger('tractor_id');
            $table->timestamps();

            $table->foreign('id_status')->references('id')->on('states')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('tractor_id')->references('id')->on('tractors')->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pipes');
    }
}
