<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tipoVehiculo extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'tipo_vehiculo';

    protected $fillable = [
        'nombre',
    ];

    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class);
    }
}
