<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehiculo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'vehiculo';

    protected $fillable = [
        'tipo_vehiculo_id',
        'estado_id',
        'placa', 
        'marca', 
        'modelo', 
        'anio', 
        'tipo_contrato', 
        'capacidad',
        'disponible',
    ];

    public function TipoVehiculo()
    {
        return $this->belongsTo(tipoVehiculo::class);
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function conductores()
    {
        return $this->belongsToMany(Conductor::class);
    }

    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class);
    }
}
