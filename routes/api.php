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
use App\Http\Controllers\RutaController;
use App\Http\Controllers\DirectionsController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificacionesController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\AuditoriaController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('hola', [MiControlador::class, 'miMetodo']);


//Estados
Route::get('estados', [EstadoController::class, 'index']); 
Route::get('estados/{id}', [EstadoController::class, 'show']); 
Route::post('estados', [EstadoController::class, 'store']);
Route::put('estados/{id}', [EstadoController::class, 'update']);
Route::delete('estados/{id}', [EstadoController::class, 'destroy']);

//Asignaciónes
Route::get('asignacion', [AsignacionController::class, 'index']); 
Route::get('asignacion/{id}', [AsignacionController::class, 'show']); 
Route::post('asignacion', [AsignacionController::class, 'store']);
Route::put('asignacion/{id}', [AsignacionController::class, 'update']);
Route::delete('asignacion/{id}', [AsignacionController::class, 'destroy']);

//Clientes
Route::get('cliente', [ClienteController::class, 'index']); 
Route::get('cliente/{id}', [ClienteController::class, 'show']);
Route::post('cliente', [ClienteController::class, 'store']);
Route::put('cliente/{id}', [ClienteController::class, 'update']);
Route::delete('cliente/{id}', [ClienteController::class, 'destroy']);

//Conductores 
Route::get('conductor', [ConductorController::class, 'index']); 
Route::get('conductor/{id}', [ConductorController::class, 'show']);
Route::post('conductor', [ConductorController::class, 'store']);
Route::put('conductor/{id}', [ConductorController::class, 'update']);
Route::delete('conductor/{id}', [ConductorController::class, 'destroy']);

//Conductores_vehiculos
Route::get('conductor_vehiculo', [conductorVehiculoController::class, 'index']); 
Route::get('conductor_vehiculo/{id}', [conductorVehiculoController::class, 'show']);
Route::post('conductor_vehiculo', [conductorVehiculoController::class, 'store']);
Route::put('conductor_vehiculo/{id}', [conductorVehiculoController::class, 'update']);
Route::delete('conductor_vehiculo/{id}', [conductorVehiculoController::class, 'destroy']);

//Envios
Route::get('envio', [EnviosController::class, 'index']); 
Route::get('envio/{id}', [EnviosController::class, 'show']);
Route::post('envio', [EnviosController::class, 'store']);
Route::put('envio/{id}', [EnviosController::class, 'update']);
Route::delete('envio/{id}', [EnviosController::class, 'destroy']);

//Facturas
Route::get('factura', [FacturaController::class, 'index']); 
Route::get('factura/{id}', [FacturaController::class, 'show']);
Route::post('factura', [FacturaController::class, 'store']);
Route::put('factura/{id}', [FacturaController::class, 'update']);
Route::delete('factura/{id}', [FacturaController::class, 'destroy']);

//Mantenimientos
Route::get('mantenimiento', [MantenimientoController::class, 'index']); 
Route::get('mantenimiento/{id}', [MantenimientoController::class, 'show']);
Route::post('mantenimiento', [MantenimientoController::class, 'store']);
Route::put('mantenimiento/{id}', [MantenimientoController::class, 'update']);
Route::delete('mantenimiento/{id}', [MantenimientoController::class, 'destroy']);

//Mantenimiento_detalles
Route::get('mantenimiento_detalle', [mantenimientoDetalleController::class, 'index']); 
Route::get('mantenimiento_detalle/{id}', [mantenimientoDetalleController::class, 'show']);
Route::post('mantenimiento_detalle', [mantenimientoDetalleController::class, 'store']);
Route::put('mantenimiento_detalle/{id}', [mantenimientoDetalleController::class, 'update']);
Route::delete('mantenimiento_detalle/{id}', [mantenimientoDetalleController::class, 'destroy']);

//Maquinarias
Route::get('maquinaria', [MaquinariaController::class, 'index']); 
Route::get('maquinaria/{id}', [MaquinariaController::class, 'show']);
Route::post('maquinaria', [MaquinariaController::class, 'store']);
Route::put('maquinaria/{id}', [MaquinariaController::class, 'update']);
Route::delete('maquinaria/{id}', [MaquinariaController::class, 'destroy']);

//Personas
Route::get('persona', [PersonaController::class, 'index']); 
Route::get('persona/{id}', [PersonaController::class, 'show']);
Route::post('persona', [PersonaController::class, 'store']);
Route::put('persona/{id}', [PersonaController::class, 'update']);
Route::delete('persona/{id}', [PersonaController::class, 'destroy']);

//Roles
Route::get('rol', [RolController::class, 'index']); 
Route::get('rol/{id}', [RolController::class, 'show']);
Route::post('rol', [RolController::class, 'store']);
Route::put('rol/{id}', [RolController::class, 'update']);
Route::delete('rol/{id}', [RolController::class, 'destroy']);

//Rutas
Route::get('ruta', [RutaController::class, 'index']); 
Route::get('ruta/{id}', [RutaController::class, 'show']);
Route::post('ruta', [RutaController::class, 'store']);
Route::put('ruta/{id}', [RutaController::class, 'update']);
Route::delete('ruta/{id}', [RutaController::class, 'destroy']);

//Servicios
Route::get('servicio', [ServicioController::class, 'index']); 
Route::get('servicio/{id}', [ServicioController::class, 'show']);
Route::post('servicio', [ServicioController::class, 'store']);
Route::put('servicio/{id}', [ServicioController::class, 'update']);
Route::delete('servicio/{id}', [ServicioController::class, 'destroy']);

//Tipo_identificaciones
Route::get('tipo_identificacion', [tipoIdentificacionController::class, 'index']); 
Route::get('tipo_identificacion/{id}', [tipoIdentificacionController::class, 'show']);
Route::post('tipo_identificacion', [tipoIdentificacionController::class, 'store']);
Route::put('tipo_identificacion/{id}', [tipoIdentificacionController::class, 'update']);
Route::delete('tipo_identificacion/{id}', [tipoIdentificacionController::class, 'destroy']);

//Tipo_intervalos
Route::get('tipo_intervalo', [tipoIntervaloController::class, 'index']); 
Route::get('tipo_intervalo/{id}', [tipoIntervaloController::class, 'show']);
Route::post('tipo_intervalo', [tipoIntervaloController::class, 'store']);
Route::put('tipo_intervalo/{id}', [tipoIntervaloController::class, 'update']);
Route::delete('tipo_intervalo/{id}', [tipoIntervaloController::class, 'destroy']);

//Tipo_mantenimientos
Route::get('tipo_mantenimiento', [tipoMantenimientoController::class, 'index']); 
Route::get('tipo_mantenimiento/{id}', [tipoMantenimientoController::class, 'show']);
Route::post('tipo_mantenimiento', [tipoMantenimientoController::class, 'store']);
Route::put('tipo_mantenimiento/{id}', [tipoMantenimientoController::class, 'update']);
Route::delete('tipo_mantenimiento/{id}', [tipoMantenimientoController::class, 'destroy']);

//Tipo_pagos
Route::get('tipo_pago', [tipoPagoController::class, 'index']); 
Route::get('tipo_pago/{id}', [tipoPagoController::class, 'show']);
Route::post('tipo_pago', [tipoPagoController::class, 'store']);
Route::put('tipo_pago/{id}', [tipoPagoController::class, 'update']);
Route::delete('tipo_pago/{id}', [tipoPagoController::class, 'destroy']);

//Tipo_vehiculos
Route::get('tipo_vehiculo', [tipoVehiculoController::class, 'index']); 
Route::get('tipo_vehiculo/{id}', [tipoVehiculoController::class, 'show']);
Route::post('tipo_vehiculo', [tipoVehiculoController::class, 'store']);
Route::put('tipo_vehiculo/{id}', [tipoVehiculoController::class, 'update']);
Route::delete('tipo_vehiculo/{id}', [tipoVehiculoController::class, 'destroy']);

//Ubicacion_origenes
Route::get('ubicacion_origen', [ubicacionOrigenController::class, 'index']); 
Route::get('ubicacion_origen/{id}', [ubicacionOrigenController::class, 'show']);
Route::post('ubicacion_origen', [ubicacionOrigenController::class, 'store']);
Route::put('ubicacion_origen/{id}', [ubicacionOrigenController::class, 'update']);
Route::delete('ubicacion_origen/{id}', [ubicacionOrigenController::class, 'destroy']);

//Ubicacion_destinos
Route::get('ubicacion_destino', [ubicacionDestinoController::class, 'index']); 
Route::get('ubicacion_destino/{id}', [ubicacionDestinoController::class, 'show']);
Route::post('ubicacion_destino', [ubicacionDestinoController::class, 'store']);
Route::put('ubicacion_destino/{id}', [ubicacionDestinoController::class, 'update']);
Route::delete('ubicacion_destino/{id}', [ubicacionDestinoController::class, 'destroy']);

//Usuarios
Route::get('usuario', [UsuarioController::class, 'index']); 
Route::get('usuario/{id}', [UsuarioController::class, 'show']);
Route::post('usuario', [UsuarioController::class, 'store']);
Route::put('usuario/{id}', [UsuarioController::class, 'update']);
Route::delete('usuario/{id}', [UsuarioController::class, 'destroy']);

//Usuario_roles
Route::get('usuario_rol', [usuarioRolController::class, 'index']); 
Route::get('usuario_rol/{id}', [usuarioRolController::class, 'show']);
Route::post('usuario_rol', [usuarioRolController::class, 'store']);
Route::put('usuario_rol/{id}', [usuarioRolController::class, 'update']);
Route::delete('usuario_rol/{id}', [usuarioRolController::class, 'destroy']);

//Vehiculos
Route::get('vehiculo', [VehiculoController::class, 'index']); 
Route::get('vehiculo/{id}', [VehiculoController::class, 'show']);
Route::post('vehiculo', [VehiculoController::class, 'store']);
Route::put('vehiculo/{id}', [VehiculoController::class, 'update']);
Route::delete('vehiculo/{id}', [VehiculoController::class, 'destroy']);

//Directions prueba api funcional
Route::get('/directions', [DirectionsController::class, 'show']);

//Usar en el mapa
Route::post('/directions', [DirectionsController::class, 'store']);

//filtrado por cedula y nombre : persona
Route::get('/personas/filter', [PersonaController::class, 'filter']);

//filtrado por cedula y nombre : persona
Route::get('/conductores/filter', [ConductorController::class, 'filter']);

//filtrado por persona_id: cliente
Route::get('/clientes/filter', [ClienteController::class, 'filter']);

//filtrado por disponibilidad de vehiculo
Route::get('/vehiculos/filter', [VehiculoController::class, 'filter']);

//notificacion
Route::post('/send-message', [MessageController::class, 'sendMessage']);

//filtro por fechas
Route::get('/envios/filter', [EnviosController::class, 'filterByCreationDate']);

//notificaciones
Route::get('notificaciones', [NotificacionesController::class, 'index']);
Route::get('notificaciones/{id}', [NotificacionesController::class, 'show']);
Route::post('notificaciones', [NotificacionesController::class, 'store']);
Route::put('notificaciones/{id}', [NotificacionesController::class, 'update']);
Route::delete('notificaciones/{id}', [NotificacionesController::class, 'destroy']);

//Departamento
Route::get('departamento', [DepartamentoController::class, 'index']); 
Route::get('departamento/{id}', [DepartamentoController::class, 'show']);
Route::post('departamento', [DepartamentoController::class, 'store']);
Route::put('departamento/{id}', [DepartamentoController::class, 'update']);
Route::delete('departamento/{id}', [DepartamentoController::class, 'destroy']);

//Auditoria
Route::get('auditoria', [AuditoriaController::class, 'index']); 
Route::get('auditoria/{id}', [AuditoriaController::class, 'show']);
Route::post('auditoria', [AuditoriaController::class, 'store']);
Route::put('auditoria/{id}', [AuditoriaController::class, 'update']);
Route::delete('auditoria/{id}', [AuditoriaController::class, 'destroy']);

//flitro de envios por estado y cliente
Route::get('/envios/filters', [EnviosController::class, 'filter']);

//filtro por envios de cliente_id
Route::get('/envios', [EnviosController::class, 'index1']);

//login
Route::post('/login', [UsuarioController::class, 'login']);
