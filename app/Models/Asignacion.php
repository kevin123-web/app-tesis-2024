<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asignacion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'asignacion';

    protected $fillable = [
        'ruta_id', 
        'conductor_vehiculo_id', 
        'fecha'
    ];

    public function ruta()
    {
        return $this->belongsTo(Ruta::class);
    }

    public function ConductorVehiculo()
    {
        return $this->belongsTo(conductorVehiculo::class);
    }

    public function envios()
    {
        return $this->hasMany(Envios::class);
    }
}
