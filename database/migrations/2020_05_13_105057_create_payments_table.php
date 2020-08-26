<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_estacion');
            $table->double('cantidad', 12, 2);
            $table->string('url');
            $table->unsignedBigInteger('id_status');
            $table->timestamps();

            $table->foreign('id_estacion')->references('id')->on('estacions')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('id_status')->references('id')->on('statu_orders')->onDelete('cascade')
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
        Schema::dropIfExists('payments');
    }
}
