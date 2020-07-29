<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTractorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tractors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_status');
            $table->string('tractor');
            $table->string('placas');
            $table->string('marca');
            $table->string('modelo');
            $table->string('descripcion')->nullable();
            $table->timestamps();
            $table->foreign('id_status')->references('id')->on('states')->onDelete('cascade')
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
        Schema::dropIfExists('tractors');
    }
}
