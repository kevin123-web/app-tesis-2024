<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUbicacionDestinoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ubicacion_destino', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->timestamps(); 

            $table->string('nombre')
            ->nullable();
            
            $table->float('latitud'); 
            $table->float('longitud');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ubicacion_destino');
    }
}
