<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ruta extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'ruta';

    protected $fillable = [
        'ubicacion_origen_id',
        'ubicacion_destino_id',
        'distancia',
        'duracion'
    ];

    public function ubicacionOrigen()
    {
        return $this->belongsTo(UbicacionOrigen::class);
    }

    public function ubicacionDestino()
    {
        return $this->belongsTo(UbicacionDestino::class);
    }
    
    public function asignaciones()
    {
        return $this->hasMany(Asignacion::class);
    }
}
