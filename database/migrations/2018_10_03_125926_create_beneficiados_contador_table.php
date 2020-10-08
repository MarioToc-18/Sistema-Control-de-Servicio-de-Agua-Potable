<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeneficiadosContadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiados_contador', function (Blueprint $table) {
            $table->increments('id_beneficiado_contador');
            $table->unsignedInteger('id_beneficiado');
            $table->integer('rama');
            $table->integer('numero_contador');
            $table->date('fecha_inicio');
            $table->boolean('esta_eliminado')->default(false);
            $table->unique(['rama','numero_contador']);
            $table->timestamps();
            $table->foreign('id_beneficiado')->references('id_beneficiado')->on('beneficiados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beneficiados_contador');
    }
}
