<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecibosTrasladoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recibos_traslado', function (Blueprint $table) {
            $table->increments('id_recibo_traslado');
            $table->unsignedInteger('id_recibo_original');
            $table->unsignedInteger('id_recibo_nuevo');
            $table->date('fecha_transaccion');
            $table->boolean('esta_eliminado')->default(false);
            $table->timestamps();
            $table->foreign('id_recibo_original')->references('id_recibo')->on('recibos');
            $table->foreign('id_recibo_nuevo')->references('id_recibo')->on('recibos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recibos_traslado');
    }
}
