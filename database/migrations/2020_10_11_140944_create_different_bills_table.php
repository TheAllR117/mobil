<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDifferentBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('different_bills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_estacion');
            $table->string('description');
            $table->boolean('add_or_subtract');
            $table->string('quantity');
            $table->string('file_pdf');
            $table->string('file_xml');
            $table->unsignedBigInteger('id_status');
            $table->timestamps();

            $table->foreign('id_estacion')->references('id')->on('estacions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_status')->references('id')->on('statu_orders')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('different_bills');
    }
}
