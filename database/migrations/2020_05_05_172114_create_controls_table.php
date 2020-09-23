<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('controls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_freights');
            //$table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('terminal_id');
            $table->unsignedBigInteger('id_chofer');
            $table->unsignedBigInteger('pipe_id_1')->nullable();
            $table->unsignedBigInteger('pipe_id_2')->nullable();
            $table->unsignedBigInteger('pipe_id_3')->nullable();
            $table->date('dia_entrega')->nullable();
            $table->timestamps();

            $table->foreign('id_freights')->references('id')->on('freights')->onDelete('cascade')->onUpdate('cascade');
            //$table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('terminal_id')->references('id')->on('terminals')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('id_chofer')->references('id')->on('drivers')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('pipe_id_1')->references('id')->on('pipes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pipe_id_2')->references('id')->on('pipes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pipe_id_3')->references('id')->on('pipes')->onDelete('cascade')->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('controls');
    }
}
