<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'usuario';

    protected $fillable = [
        'nombre_usuario', 'nombre', 'email', 'contrasena'
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Rol::class);
    }
}
