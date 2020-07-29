<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNameFreightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('name_freights', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('rfc');
            $table->string('cre');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('contacto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('name_freights');
    }
}
