<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('cliente_id')->constrained('cliente');
            $table->foreignId('envio_id')->constrained('envios');
            $table->foreignId('estado_id')->constrained('estado');
            $table->foreignId('tipo_pago_id')->constrained('tipo_pago');



            $table->date('fecha');

            $table->double('subtotal',800, 2)
            ->default(0);

            $table->double('total',800, 2)
            ->default(0);

            $table->boolean('con_iva')
            ->default("FALSE");

            $table->boolean('servicio')
            ->default("FALSE");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factura');
    }
}
