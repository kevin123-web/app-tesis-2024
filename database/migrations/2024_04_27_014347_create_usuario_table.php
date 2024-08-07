<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('rol_id')->constrained('rol');
            $table->foreignId('departamento_id')->constrained('departamento');


            $table->string('nombre_usuario', 50)
            ->unique();

            $table->string('nombre', 50)
            ->nullable();

            $table->string('email', 50)
            ->nullable();

            $table->string('contrasena', 100)
            ->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario');
    }
}
