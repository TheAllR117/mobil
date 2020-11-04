<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_order');
            $table->double('cantidad', 12, 2);
            $table->string('url');
            $table->unsignedBigInteger('id_status');
            $table->dateTime('deposit_date');
            $table->timestamps();

            $table->foreign('id_order')->references('id')->on('orders')->onDelete('cascade')
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
        Schema::dropIfExists('order_payments');
    }
}
