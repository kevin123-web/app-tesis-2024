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
use App\Models\Notificaciones;
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
        tipoIdentificacion::factory()->count(3)->has(Persona::factory()->count(3))->create();
        Estado::factory()->count(3)->create();
        tipoVehiculo::factory()->count(3)->create();
        Servicio::factory()->count(3)->create();
        tipoIntervalo::factory()->count(3)->create();
        mantenimientoDetalle::factory()->count(3)->create();
        Maquinaria::factory()->count(3)->create();
        tipoMantenimiento::factory()->count(3)->create();
        Rol::factory()->count(3)->create();
        tipoPago::factory()->count(3)->create();
        Notificaciones::factory()->count(3)->create();

        $faker = Faker::create(); 

           // Crear ubicaciones de origen y destino
           for ($i = 0; $i < 3; $i++) {
            ubicacionOrigen::create([
                'nombre' => $faker->city,
                'latitud' => $faker->latitude,
                'longitud' => $faker->longitude,
            ]);
        }

        for ($i = 0; $i < 3; $i++) {
            ubicacionDestino::create([
                'nombre' => $faker->city,
                'latitud' => $faker->latitude,
                'longitud' => $faker->longitude,
            ]);
        }

        for ($i = 0; $i < 3; $i++) {
            Vehiculo::create([
                'tipo_vehiculo_id' => random_int(1, 3), 
                'estado_id' => random_int(1, 3), 
                'placa' => $faker->lexify('???###'), 
                'marca' => $faker->company,
                'modelo' => $faker->word, 
                'anio' => $faker->numberBetween(2000, 2022), 
                'tipo_contrato' => $faker->randomElement(['leasing', 'compra']), 
                'capacidad' => $faker->numberBetween(1, 5),
                'disponible' => true 
            ]);
        }

        for ($i = 0; $i < 3; $i++) {
            Conductor::create([
                'persona_id' => random_int(1, 3), 
                'estado_id' => random_int(1, 3), 
                'licencia_conducir' => $faker->lexify('???###'), 
                'hacer_user' => false, 
            ]);
        }

        for ($i = 0; $i < 3; $i++) {
            conductorVehiculo::create([
                'vehiculo_id' => random_int(1, 3), 
                'conductor_id' => random_int(1, 3), 
            ]);
        }

        for ($i = 0; $i < 3; $i++) {
            Ruta::create([
                'ubicacion_origen_id' => random_int(1, 3), 
                'ubicacion_destino_id' => random_int(1, 3), 
                'duracion' => $faker->randomFloat(2, 0, 800),
                'distancia' => $faker->randomFloat(2, 0, 800),
            ]);
        }    
        
        for ($i = 0; $i < 3; $i++) {
            Asignacion::create([
                'ruta_id' => random_int(1, 3), 
                'conductor_vehiculo_id' => random_int(1, 3), 
                'fecha' => $faker->date(),
            ]);
        }

        for ($i = 0; $i < 3; $i++) {
            Cliente::create([
                'persona_id' => random_int(1, 3), 
                'fecha_registro' => $faker->date(), 
                'tipo_cliente' => $faker->randomElement(['persona', 'empresa']), 
            ]);
        }

        for ($i = 0; $i < 3; $i++) {
            Envios::create([
                'cliente_id' => random_int(1, 3), 
                'asignacion_id' => random_int(1, 3),
                'servicio_id' => random_int(1, 3), 
                'estado_id' => random_int(1, 3), 
                'descripcion' => $faker->sentence(), 
                'peso_mercancia' => $faker->randomFloat(2, 0, 800), 
                'fecha_recogida' => $faker->date(), 
                'fecha_entrega' => $faker->date(),
                'prioridad' => $faker->sentence()
            ]);
        }

        for ($i = 0; $i < 3; $i++) {
            Mantenimiento::create([
                'vehiculo_id' => random_int(1, 3), 
                'mantenimiento_detalle_id' => random_int(1, 3), 
                'maquinaria_id' => random_int(1, 3),
                'tipo_mantenimiento_id' => random_int(1, 3), 
                'tipo_intervalo_id' => random_int(1, 3), 
                'fecha_mantenimiento' => $faker->date(), 
                'costo_mantenimiento' => $faker->randomFloat(2, 0, 800), 
                'intervalo_numero' => $faker->numberBetween(0, 30), 
            ]);
        }

        for ($i = 0; $i < 3; $i++) {
            Usuario::create([
                'rol_id' => random_int(1, 3), 
                'nombre_usuario' => $faker->userName(), 
                'nombre' => $faker->name(), 
                'email' => $faker->email(), 
                'contrasena' => bcrypt('password'), 
            ]);
        }

        for ($i = 0; $i < 3; $i++) {
            usuarioRol::create([
                'rol_id' => random_int(1, 3), 
                'usuario_id' => random_int(1, 3), 
            ]);
        }

        for ($i = 0; $i < 3; $i++) {
            Factura::create([
                'cliente_id' => random_int(1, 3), 
                'envio_id' => random_int(1, 3),
                'estado_id' => random_int(1, 3), 
                'tipo_pago_id' => random_int(1, 3), 
                'fecha' => $faker->date(), 
                'subtotal' => $faker->randomFloat(2, 0, 800), 
                'total' => $faker->randomFloat(2, 0, 800), 
                'con_iva' => false, 
                'servicio' => false, 
            ]);
        }

        
    }
}