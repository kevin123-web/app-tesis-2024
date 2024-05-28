<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estado;
use App\Models\tipoIdentificacion;
use App\Models\Persona;
use App\Models\Vehiculo;
use App\Models\tipoVehiculo;
use App\Models\Conductor;
use App\Models\Ruta;
use App\Models\ubicacionOrigen;
use App\Models\ubicacionDestino;
use App\Models\Asignacion;
use App\Models\conductorVehiculo;
use App\Models\Cliente;
use App\Models\Envios;
use App\Models\Mantenimiento;
use App\Models\Maquinaria;
use App\Models\tipoMantenimiento;
use App\Models\tipoIntervalo;
use App\Models\Usuario;
use App\Models\Rol;
use App\Models\tipoPago;
use App\Models\Factura;
use App\Models\Servicio;
use App\Models\mantenimientoDetalle;
use App\Models\usuarioRol;
use Faker\Factory as Faker; 


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        tipoIdentificacion::factory()->count(10)->has(Persona::factory()->count(10))->create();
        Estado::factory()->count(10)->create();
        tipoVehiculo::factory()->count(10)->create();
        ubicacionOrigen::factory()->count(10)->create();
        ubicacionDestino::factory()->count(10)->create();
        Servicio::factory()->count(10)->create();
        tipoIntervalo::factory()->count(10)->create();
        mantenimientoDetalle::factory()->count(10)->create();
        Maquinaria::factory()->count(10)->create();
        tipoMantenimiento::factory()->count(10)->create();
        Rol::factory()->count(10)->create();
        tipoPago::factory()->count(10)->create();

        $faker = Faker::create(); 

        for ($i = 0; $i < 10; $i++) {
            Vehiculo::create([
                'tipo_vehiculo_id' => random_int(1, 10), 
                'estado_id' => random_int(1, 10), 
                'placa' => $faker->lexify('???###'), 
                'marca' => $faker->company,
                'modelo' => $faker->word, 
                'anio' => $faker->numberBetween(2000, 2022), 
                'tipo_contrato' => $faker->randomElement(['leasing', 'compra']), 
                'capacidad' => $faker->numberBetween(1, 5), 
            ]);
        }

        for ($i = 0; $i < 10; $i++) {
            Conductor::create([
                'persona_id' => random_int(1, 10), 
                'estado_id' => random_int(1, 10), 
                'licencia_conducir' => $faker->lexify('???###'), 
                'hacer_user' => false, 
            ]);
        }

        for ($i = 0; $i < 10; $i++) {
            conductorVehiculo::create([
                'vehiculo_id' => random_int(1, 10), 
                'conductor_id' => random_int(1, 10), 
            ]);
        }

        for ($i = 0; $i < 10; $i++) {
            Ruta::create([
                'estado_id' => random_int(1, 10), 
                'ubicacion_origen_id' => random_int(1, 10), 
                'ubicacion_destino_id' => random_int(1, 10), 
                'tiempo_estimado' => $faker->time(),
                'distancia' => $faker->numberBetween(1, 100), 
            ]);
        }    
        
        for ($i = 0; $i < 10; $i++) {
            Asignacion::create([
                'ruta_id' => random_int(1, 10), 
                'conductor_vehiculo_id' => random_int(1, 10), 
                'fecha' => $faker->date(), 
            ]);
        }

        for ($i = 0; $i < 10; $i++) {
            Cliente::create([
                'persona_id' => random_int(1, 10), 
                'fecha_registro' => $faker->date(), 
                'tipo_cliente' => $faker->randomElement(['persona', 'empresa']), 
            ]);
        }

        for ($i = 0; $i < 10; $i++) {
            Envios::create([
                'cliente_id' => random_int(1, 10), 
                'asignacion_id' => random_int(1, 10),
                'servicio_id' => random_int(1, 10), 
                'estado_id' => random_int(1, 10), 
                'descripcion' => $faker->sentence(), 
                'peso_mercancia' => $faker->randomFloat(2, 0, 800), 
                'fecha_recogida' => $faker->date(), 
                'fecha_entrega' => $faker->date(), 
            ]);
        }

        for ($i = 0; $i < 10; $i++) {
            Mantenimiento::create([
                'vehiculo_id' => random_int(1, 10), 
                'mantenimiento_detalle_id' => random_int(1, 10), 
                'maquinaria_id' => random_int(1, 10),
                'tipo_mantenimiento_id' => random_int(1, 10), 
                'tipo_intervalo_id' => random_int(1, 10), 
                'fecha_mantenimiento' => $faker->date(), 
                'costo_mantenimiento' => $faker->randomFloat(2, 0, 800), 
                'intervalo_numero' => $faker->numberBetween(0, 100), 
            ]);
        }

        for ($i = 0; $i < 10; $i++) {
            Usuario::create([
                'rol_id' => random_int(1, 10), 
                'nombre_usuario' => $faker->userName(), 
                'nombre' => $faker->name(), 
                'email' => $faker->email(), 
                'contrasena' => bcrypt('password'), 
            ]);
        }

        for ($i = 0; $i < 10; $i++) {
            usuarioRol::create([
                'rol_id' => random_int(1, 10), 
                'usuario_id' => random_int(1, 10), 
            ]);
        }

        for ($i = 0; $i < 10; $i++) {
            Factura::create([
                'cliente_id' => random_int(1, 10), 
                'envio_id' => random_int(1, 10),
                'estado_id' => random_int(1, 10), 
                'tipo_pago_id' => random_int(1, 10), 
                'fecha' => $faker->date(), 
                'subtotal' => $faker->randomFloat(2, 0, 800), 
                'total' => $faker->randomFloat(2, 0, 800), 
                'con_iva' => false, 
                'servicio' => false, 
            ]);
        }

        
    }
}