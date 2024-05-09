<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rol extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'rol';

    protected $fillable = [
        'nombre',
    ];

    public function usuarios()
    {
        return $this->hasMany(Usuario::class);
    }

    public function usuario()
    {
        return $this->belongsToMany(Usuario::class);
    }
}
