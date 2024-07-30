<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Departamento extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'departamento';

    protected $fillable = [
        'nombre',
    ];


    public function usuarios()
    {
        return $this->hasMany(Usuario::class);
    }
}
