<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->string('nombre'); // Nombre del producto
            $table->decimal('precio', 8, 2); // Precio con 2 decimales
            $table->integer('stock'); // Cantidad en stock
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('productos');
    }
};