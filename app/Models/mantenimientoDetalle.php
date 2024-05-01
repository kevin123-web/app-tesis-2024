<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mantenimientoDetalle extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'mantemiento_detalle';

    protected $fillable = [
        'nombre',
    ];

    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class);
    }
}
