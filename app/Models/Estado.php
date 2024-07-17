<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Estado extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'estado';

    protected $fillable = [
        'nombre',
    ];

    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class);
    }

    public function conductores()
    {
        return $this->hasMany(Conductor::class);
    }
    
    public function envios()
    {
        return $this->hasMany(Envios::class);
    }
    
    public function facturas()
    {
        return $this->hasMany(Factura::class);
    }
}
