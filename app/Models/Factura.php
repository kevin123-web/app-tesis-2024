<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Factura extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'factura';

    protected $fillable = [
        'fecha', 'subtotal', 'total', 'con_iva', 'servicio'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function envios()
    {
        return $this->belongsTo(Envios::class);
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function tipoPago()
    {
        return $this->belongsTo(TipoPago::class);
    }
}
