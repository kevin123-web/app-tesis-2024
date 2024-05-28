<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class conductorVehiculo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'conductor_vehiculo';

    protected $fillable = [
        'conductor_id',
        'vehiculo_id'
    ];

    public function asignaciones()
    {
        return $this->hasMany(Asignacion::class);
    }
}
