<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'vehiculo';

    protected $fillable = [
        'placa', 'marca', 'modelo', 'anio', 'tipo_contrato', 'capacidad'
    ];

    public function TipoVehiculo()
    {
        return $this->belongsTo(tipoVehiculo::class);
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
