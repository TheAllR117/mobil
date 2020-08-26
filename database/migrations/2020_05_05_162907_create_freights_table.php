<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freights', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_freights')->nullable();
            $table->unsignedBigInteger('id_estacion')->nullable();
            $table->unsignedBigInteger('id_tractor');
            $table->unsignedBigInteger('id_pipa_1');
            $table->unsignedBigInteger('id_pipa_2')->nullable();;            
            $table->unsignedBigInteger('id_chofer');
            $table->timestamps();

            $table->foreign('id_freights')->references('id')->on('name_freights')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_estacion')->references('id')->on('estacions')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_pipa_1')->references('id')->on('pipes')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_pipa_2')->references('id')->on('pipes')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_tractor')->references('id')->on('tractors')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_chofer')->references('id')->on('drivers')->onDelete('cascade')
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
        Schema::dropIfExists('freights');
    }
}
