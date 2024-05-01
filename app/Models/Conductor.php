<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conductor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'conductor';

    protected $fillable = [
        'liciencia_conducir', 'hacer_user'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function vehiculos()
    {
        return $this->belongsToMany(Vehiculo::class);
    }
}
