<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class conductorVehiculo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'conductor_vehiculo';

    protected $fillable = [
        
    ];

    public function asignaciones()
    {
        return $this->hasMany(Asignacion::class);
    }
}
