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
            $table->timestamps();

            $table->foreign('id_freights')->references('id')->on('freights')->onDelete('cascade')->onUpdate('cascade');
            //$table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('terminal_id')->references('id')->on('terminals')->onDelete('cascade')->onUpdate('cascade');
            
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
