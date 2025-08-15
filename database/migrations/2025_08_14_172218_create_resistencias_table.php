<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tb_resistencias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_registro')->constrained('tb_registro_produccion')->onDelete('cascade');
            
            // Campos para cada resistencia BT
            $table->integer('bt1_max')->nullable();
            $table->integer('bt1_min')->nullable();
            $table->integer('bt2_max')->nullable();
            $table->integer('bt2_min')->nullable();
            $table->integer('bt3_max')->nullable();
            $table->integer('bt3_min')->nullable();
            $table->integer('bt4_max')->nullable();
            $table->integer('bt4_min')->nullable();
            $table->integer('bt5_max')->nullable();
            $table->integer('bt5_min')->nullable();
            $table->integer('bt9_max')->nullable();
            $table->integer('bt9_min')->nullable();
            $table->integer('bt11_max')->nullable();
            $table->integer('bt11_min')->nullable();
            $table->integer('bt12_max')->nullable();
            $table->integer('bt12_min')->nullable();
            $table->integer('bt13_max')->nullable();
            $table->integer('bt13_min')->nullable();
            $table->integer('bt14_max')->nullable();
            $table->integer('bt14_min')->nullable();
            $table->integer('bt15_max')->nullable();
            $table->integer('bt15_min')->nullable();
            $table->integer('bt16_max')->nullable();
            $table->integer('bt16_min')->nullable();
            $table->integer('bt17_max')->nullable();
            $table->integer('bt17_min')->nullable();
            $table->integer('bt19_max')->nullable();
            $table->integer('bt19_min')->nullable();
            
            $table->boolean('cerrado')->default(false);
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->timestamp('fecha_actualizacion')->useCurrent()->useCurrentOnUpdate();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_resistencias');
    }
};