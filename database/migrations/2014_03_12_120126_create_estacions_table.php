<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estacions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('razon_social');
            $table->string('rfc')->nullable();
            $table->string('cre')->nullable();
            $table->string('sh')->nullable();
            $table->string('nombre_sucursal')->nullable();

            $table->string('flete_r')->nullable();
            $table->string('flete_p')->nullable();
            $table->string('flete_d')->nullable();
            $table->string('ieps_r')->nullable();
            $table->string('ieps_p')->nullable();
            $table->string('ieps_d')->nullable();
            $table->string('utilidad_r')->nullable();
            $table->string('utilidad_p')->nullable();
            $table->string('utilidad_d')->nullable();

            $table->boolean('status');
            $table->boolean('linea_credito');
            $table->boolean('datos_fiscales');

            $table->double('credito', 12, 2)->nullable();
            $table->double('credito_usado', 12, 2)->nullable();
            $table->double('saldo', 12, 2)->nullable();
            $table->integer('dias_credito')->nullable();
            $table->integer('retencion')->nullable();
            
            $table->string('codigo_postal')->nullable();
            $table->string('tipo_de_vialidad')->nullable();
            $table->string('nombre_de_vialidad')->nullable();
            $table->string('n_exterior')->nullable();
            $table->string('n_interior')->nullable();
            $table->string('nombre_colonia')->nullable();
            $table->string('nombre_localidad')->nullable();
            $table->string('nombre_municipio_o_demarcacion_territorial')->nullable();
            $table->string('nombre_entidad_federativa')->nullable();
            $table->string('entre_calle')->nullable();
            $table->string('y_calle')->nullable();
            $table->timestamps();

            //$table->foreign('id')->references('id')->on('terminals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estacions');
    }
}
