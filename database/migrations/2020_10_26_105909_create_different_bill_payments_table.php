<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDifferentBillPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('different_bill_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_different_bill');
            $table->double('cantidad', 12, 2);
            $table->string('url');
            $table->unsignedBigInteger('id_status');
            $table->timestamps();

            $table->foreign('id_different_bill')->references('id')->on('different_bills')->onDelete('cascade')
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
        Schema::dropIfExists('different_bill_payments');
    }
}
