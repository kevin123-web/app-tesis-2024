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

            $table->string('marca')
            ->nullable();
            
            $table->string('modelo')
            ->nullable();

            $table->integer('anio')
            ->nullable();

            $table->string('tipo_contrato')
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
