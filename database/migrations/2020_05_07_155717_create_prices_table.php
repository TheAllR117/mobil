<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_estacion');
            $table->double('extra', 12, 2)->nullable();
            $table->double('supreme', 12, 2)->nullable();
            $table->double('diesel', 12, 2)->nullable();
            $table->double('extra_u', 12, 2)->nullable();
            $table->double('supreme_u', 12, 2)->nullable();
            $table->double('diesel_u', 12, 2)->nullable();
            $table->timestamps();
            $table->foreign('id_estacion')->references('id')->on('estacions')->onDelete('cascade')
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
        Schema::dropIfExists('prices');
    }
}
