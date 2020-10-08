<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecibosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recibos', function (Blueprint $table) {
            $table->increments('id_recibo');
            $table->unsignedInteger('id_beneficiado_contador');
            $table->date('fecha_lectura');
            $table->integer('mes_lectura');
            $table->integer('anio_lectura');
            $table->date('fecha_max_pago');
            $table->string('serie')->default('A');
            $table->integer('numero');
            $table->integer('lectura_anterior')->nullable();
            $table->integer('lectura_actual');
            $table->decimal('cuota_fija');
            $table->decimal('consumo');
            $table->decimal('exceso')->nullable();
            $table->decimal('cuota_pendiente')->nullable();
            $table->decimal('total');
            $table->date('fecha_efectiva')->nullable();
            $table->boolean('esta_trasladado')->default(false);
            $table->boolean('esta_pagado')->default(false);
            $table->boolean('esta_eliminado')->default(false);
            $table->unique(['id_beneficiado_contador','mes_lectura', 'anio_lectura']);
            $table->timestamps();
            $table->foreign('id_beneficiado_contador')->references('id_beneficiado_contador')->on('beneficiados_contador');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recibos');
    }
}
