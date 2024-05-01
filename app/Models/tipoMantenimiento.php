<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipoMantenimiento extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tipo_mantenimiento';

    protected $fillable = [
        'nombre',
    ];

    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class);
    }
}
