<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnviosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('envios', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('cliente_id')->constrained('cliente');
            $table->foreignId('asignacion_id')->constrained('asignacion');
            $table->foreignId('servicio_id')->constrained('servicio');
            $table->foreignId('estado_id')->constrained('estado');

            $table->text('descripcion')
            ->nullable();

            $table->double('peso_mercancia' ,800, 2)
            ->default(0);

            $table->date('fecha_recogida');
            $table->date('fecha_entrega');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('envios');
    }
}
