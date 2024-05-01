<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipoPago extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tipo_pago';

    protected $fillable = [
        'nombre',
    ];

    public function facturas()
    {
        return $this->hasMany(Factura::class);
    }
}
