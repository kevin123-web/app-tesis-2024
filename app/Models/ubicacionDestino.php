<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ubicacionDestino extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'ubicacion_destino';

    protected $fillable = [
        'nombre',
    ];

    public function rutas()
    {
        return $this->hasMany(Ruta::class);
    }
}
