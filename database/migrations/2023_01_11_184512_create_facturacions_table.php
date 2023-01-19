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
        Schema::create('facturacion', function (Blueprint $table) {
            $table->id();
            $table->integer('id_movimiento');
            $table->string('nota');
            $table->decimal('dinero_recibido');
            $table->decimal('dinero_devuelto');
            $table->decimal('costo_total');
            $table->date('fecha');
            $table->foreign('id_movimiento')
                    ->references('id_movimiento')
                    ->on('movimientos');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facturacion');
    }
};
