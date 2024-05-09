<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tipoIdentificacion extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'tipo_identificacion';

    protected $fillable = [
        'nombre',
    ];

    public function personas()
    {
        return $this->hasMany(Persona::class);
    }
}
