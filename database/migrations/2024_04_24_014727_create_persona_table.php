<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('tipo_identificacion_id')->constrained('tipo_identificacion');

            $table->string('nombre');
            
            $table->string('cedula', 10)
            ->unique();

            $table->string('email')
            ->unique();

            $table->string('sexo');

            $table->text('direccion');

            $table->string('celular', 10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persona');
    }
}
