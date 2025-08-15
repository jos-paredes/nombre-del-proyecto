<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdFormularioGeneralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('prod_formulario_general', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_registro');
        $table->string('tonalidad');
        $table->string('dosificacion_eco')->nullable();
        $table->string('gramaje')->nullable();
        $table->string('punto_ajuste')->nullable();
        $table->string('temp_proceso')->nullable();
        $table->string('dewpoint')->nullable();
        $table->string('temp_cono')->nullable();
        $table->string('presion_entrada_agua_molde')->nullable();
        $table->string('presion_salida_agua_molde')->nullable();
        $table->string('presion_entrada_agua_maquina')->nullable();
        $table->string('presion_salida_agua_maquina')->nullable();
        $table->string('punto_ajuste_chiller_2')->nullable();
        $table->string('lectura_chiller_2')->nullable();
        $table->string('temp_motor_m2')->nullable();
        $table->string('temp_aire_torre_entrada')->nullable();
        $table->string('velocidad_tornillo')->nullable();
        $table->string('temp_aire_torre_salida')->nullable();
        $table->string('temp_cilindro')->nullable();
        $table->string('torre_cama1d')->nullable();
        $table->string('caudal_aire')->nullable();
        $table->string('temp_intercambiados')->nullable();
        $table->boolean('cerrado')->default(false);
        $table->timestamps();
        
        $table->foreign('id_registro')->references('id')->on('registros_produccion');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_prod_formulario_general');
    }
}
