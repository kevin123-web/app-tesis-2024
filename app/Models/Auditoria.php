<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Auditoria extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'auditoria';

    protected $fillable = [
        'envio_id',
        'usuario_id',
        'descripcion',
  
    ];
    public function envios()
    {
        return $this->belongsTo(Envios::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
