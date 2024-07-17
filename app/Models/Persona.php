<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'persona';

    protected $fillable = [
        'tipo_identificacion_id',
        'nombre', 
        'cedula', 
        'email', 
        'sexo', 
        'direccion', 
        'celular'
    ];

    public function TipoIdentificacion()
    {
        return $this->belongsTo(tipoIdentificacion::class);
    }

    public function conductor()
    {
        return $this->hasOne(Conductor::class);
    }

    public function clientes()
    {
        return $this->hasMany(Cliente::class);
    }
}
