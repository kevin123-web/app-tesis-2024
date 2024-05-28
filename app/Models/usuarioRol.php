<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class usuarioRol extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'usuario_rol';

    protected $fillable = [
        'rol_id',
        'usuario_id'
    ];
}
