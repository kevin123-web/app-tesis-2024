<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'usuario';

    protected $fillable = [
        'rol_id',
        'departamento_id',
        'nombre_usuario', 
        'nombre', 'email', 
        'contrasena'
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Rol::class);
    }

    public function departamentos()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function auditoria()
    {
        return $this->hasMany(Auditoria::class);
    }
}
