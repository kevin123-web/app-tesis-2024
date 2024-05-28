<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'cliente';

    protected $fillable = [
        'persona_id',
        'fecha_registro', 
        'tipo_cliente'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
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
