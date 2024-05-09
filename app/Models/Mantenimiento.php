<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mantenimiento extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'mantenimiento';

    protected $fillable = [
        'fecha_mantenimiento', 'costo_mantenimiento', 'intervalo_numero'
    ];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function MantenimientoDetalle()
    {
        return $this->belongsTo(mantenimientoDetalle::class);
    }

    public function maquinaria()
    {
        return $this->belongsTo(Maquinaria::class);
    }

    public function TipoMantenimiento()
    {
        return $this->belongsTo(tipoMantenimiento::class);
    }

    public function TipoIntervalo()
    {
        return $this->belongsTo(tipoIntervalo::class);
    }
}
