<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMantenimientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mantenimiento', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('vehiculo_id')->constrained('vehiculo');
            $table->foreignId('mantenimiento_detalle_id')->constrained('mantenimiento_detalle');
            $table->foreignId('maquinaria_id')->constrained('maquinaria');

            
            $table->date('fecha_mantenimiento');
            $table->double('costo_mantenimiento',800, 2);
            $table->string('intervalo_mantenimiento', 50);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mantenimiento');
    }
}
