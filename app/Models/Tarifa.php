<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tarifa extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tarifa';

    protected $fillable = [
        'tipo_vehiculo_id',
        'valor',
    ];

    public function TipoVehiculo()
    {
        return $this->belongsTo(tipoVehiculo::class);
    }
}
