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

            
            $table->string('placa', 10)
            ->nullable()
            ->unique();

            $table->string('marca', 20)
            ->nullable();
            
            $table->string('modelo', 20)
            ->nullable();

            $table->integer('anio')
            ->nullable();

            $table->string('tipo_contrato', 50)
            ->nullable();

            $table->integer('capacidad')
            ->default(0);

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
