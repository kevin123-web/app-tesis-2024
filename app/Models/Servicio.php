<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'servicio';

    protected $fillable = [
        'nombre',
    ];

    public function envios()
    {
        return $this->hasMany(Envios::class);
    }
}
