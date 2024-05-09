<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ubicacionOrigen extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'ubicacion_origen';

    protected $fillable = [
        'nombre',
    ];

    public function rutas()
    {
        return $this->hasMany(Ruta::class);
    }
}
