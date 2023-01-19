<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->string('codigo');
            $table->string('nombre');
            $table->string('descripcion');
            $table->decimal('precioCompra');
            $table->decimal('precioVenta');
            $table->integer('stock');
            $table->string('categoria');
            $table->primary('codigo');
            $table->foreign('categoria')
                    ->references('codigo')
                    ->on('familias')
                    ->onDelete('cascade')
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
        Schema::dropIfExists('articulos');
    }
};
