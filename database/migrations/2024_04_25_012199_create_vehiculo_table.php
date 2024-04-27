<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculo', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('tipo_vehiculo_id')->constrained('tipo_vehiculo');
            $table->foreignId('estado_id')->constrained('estado');

            
            $table->string('placa', 10);
            $table->string('marca', 20);
            $table->string('modelo', 20);
            $table->integer('anio');
            $table->string('tipo_contrato', 50);
            $table->integer('capacidad');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehiculo');
    }
}
