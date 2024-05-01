<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maquinaria extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tipo_identificacion';

    protected $fillable = [
        'nombre',
    ];

    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class);
    }
}
