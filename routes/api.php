<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\MiControlador;
use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ConductorController;
use App\Http\Controllers\conductorVehiculoController;
use App\Http\Controllers\EnviosController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\mantenimientoDetalleController;
use App\Http\Controllers\MaquinariaController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\tipoIdentificacionController;
use App\Http\Controllers\tipoIntervaloController;
use App\Http\Controllers\tipoMantenimientoController;
use App\Http\Controllers\tipoPagoController;
use App\Http\Controllers\tipoVehiculoController;
use App\Http\Controllers\ubicacionDestinoController;
use App\Http\Controllers\ubicacionOrigenController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\usuarioRolController;
use App\Http\Controllers\VehiculoController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('hola', [MiControlador::class, 'miMetodo']);


//Estados
Route::get('estados', [EstadoController::class, 'index']); 
Route::get('estados/{id}', [EstadoController::class, 'show']); 

//Asignaciónes
Route::get('asignacion', [AsignacionController::class, 'index']); 
Route::get('asignacion/{id}', [AsignacionController::class, 'show']); 

//Clientes
Route::get('cliente', [ClienteController::class, 'index']); 
Route::get('cliente/{id}', [ClienteController::class, 'show']);

//Conductores 
Route::get('conductor', [ConductorController::class, 'index']); 
Route::get('conductor/{id}', [ConductorController::class, 'show']);

//Conductores_vehiculos
Route::get('conductor_vehiculo', [conductorVehiculoController::class, 'index']); 
Route::get('conductor_vehiculo/{id}', [conductorVehiculoController::class, 'show']);

//Envios
Route::get('envio', [EnviosController::class, 'index']); 
Route::get('envio/{id}', [EnviosController::class, 'show']);

//Facturas
Route::get('factura', [FacturaController::class, 'index']); 
Route::get('factura/{id}', [FacturaController::class, 'show']);

//Mantenimientos
Route::get('mantenimiento', [MantenimientoController::class, 'index']); 
Route::get('mantenimiento/{id}', [MantenimientoController::class, 'show']);

//Mantenimiento_detalles
Route::get('mantenimiento_detalle', [mantenimientoDetalleController::class, 'index']); 
Route::get('mantenimiento_detalle/{id}', [mantenimientoDetalleController::class, 'show']);

//Maquinarias
Route::get('maquinaria', [MaquinariaController::class, 'index']); 
Route::get('maquinaria/{id}', [MaquinariaController::class, 'show']);

//Personas
Route::get('persona', [PersonaController::class, 'index']); 
Route::get('persona/{id}', [PersonaController::class, 'show']);

//Roles
Route::get('rol', [RolController::class, 'index']); 
Route::get('rol/{id}', [RolController::class, 'show']);

//Servicios
Route::get('servicio', [ServicioController::class, 'index']); 
Route::get('servicio/{id}', [ServicioController::class, 'show']);

//Tipo_identificaciones
Route::get('tipo_identificacion', [tipoIdentificacionController::class, 'index']); 
Route::get('tipo_identificacion/{id}', [tipoIdentificacionController::class, 'show']);

//Tipo_intervalos
Route::get('tipo_intervalo', [tipoIntervaloController::class, 'index']); 
Route::get('tipo_intervalo/{id}', [tipoIntervaloController::class, 'show']);

//Tipo_mantenimientos
Route::get('tipo_mantenimiento', [tipoMantenimientoController::class, 'index']); 
Route::get('tipo_mantenimiento/{id}', [tipoMantenimientoController::class, 'show']);

//Tipo_pagos
Route::get('tipo_pago', [tipoPagoController::class, 'index']); 
Route::get('tipo_pago/{id}', [tipoPagoController::class, 'show']);

//Tipo_vehiculos
Route::get('tipo_vehiculo', [tipoVehiculoController::class, 'index']); 
Route::get('tipo_vehiculo/{id}', [tipoVehiculoController::class, 'show']);

//Ubicacion_destinos
Route::get('ubicacion_destino', [ubicacionDestinoController::class, 'index']); 
Route::get('ubicacion_destino/{id}', [ubicacionDestinoController::class, 'show']);

//Usuarios
Route::get('usuario', [UsuarioController::class, 'index']); 
Route::get('usuario/{id}', [UsuarioController::class, 'show']);

//Usuario_roles
Route::get('usuario_rol', [usuarioRolController::class, 'index']); 
Route::get('usuario_rol/{id}', [usuarioRolController::class, 'show']);

//Vehiculos
Route::get('vehiculo', [VehiculoController::class, 'index']); 
Route::get('vehiculo/{id}', [VehiculoController::class, 'show']);

