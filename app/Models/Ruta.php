<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'ruta';

    protected $fillable = [
        'tiempo_estimado', 'distancia'
    ];

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

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
