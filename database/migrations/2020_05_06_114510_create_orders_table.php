<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('control_id')->nullable();
            $table->unsignedBigInteger('pipe_id')->nullable();
            $table->unsignedBigInteger('estacion_id');
            //$table->unsignedBigInteger('factura_id')->nullable();
            $table->unsignedBigInteger('status_id');
            $table->string('producto');
            $table->string('so_number')->nullable();
            $table->integer('cantidad_lts');
            $table->double('costo_aprox', 12, 3)->nullable();
            $table->string('dia_entrega');
            $table->string('po')->nullable();
            $table->string('pdf')->nullable();
            $table->string('xml')->nullable();

            $table->string('fecha_expiracion');
            $table->enum('pagado', ['TRUE','FALSE'])->default('FALSE');
            $table->string('metodo_pago');
            $table->double('total_abonado', 12, 3)->nullable();

            $table->timestamps();


            $table->foreign('control_id')->references('id')->on('controls')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('estacion_id')->references('id')->on('estacions')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('pipe_id')->references('id')->on('pipes')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('status_id')->references('id')->on('statu_orders')->onDelete('cascade')
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
        Schema::dropIfExists('orders');
    }
}
