<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conductor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'conductor';

    protected $fillable = [
        'estado_id',
        'persona_id',
        'licencia_conducir', 
        'hacer_user',
        'disponible'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function vehiculos()
    {
        return $this->belongsToMany(Vehiculo::class);
    }
}
