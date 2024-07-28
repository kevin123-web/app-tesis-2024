<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Envios extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'envios';

    protected $fillable = [
        'cliente_id',
        'asignacion_id',
        'servicio_id',
        'estado_id',
        'descripcion', 
        'peso_mercancia', 
        'fecha_recogida', 
        'fecha_entrega',
        'prioridad',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function asignacion()
    {
        return $this->belongsTo(Asignacion::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function facturas()
    {
        return $this->hasMany(Factura::class);
    }
}
