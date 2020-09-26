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
            $table->unsignedBigInteger('terminal_id');
            $table->unsignedBigInteger('id_chofer');
            $table->date('dia_entrega')->nullable();
            $table->timestamps();

            $table->foreign('id_freights')->references('id')->on('freights')->onDelete('cascade')->onUpdate('cascade');
        
            $table->foreign('terminal_id')->references('id')->on('terminals')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('id_chofer')->references('id')->on('drivers')->onDelete('cascade')->onUpdate('cascade');
            
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
