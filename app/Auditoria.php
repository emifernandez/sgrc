<?php

namespace App;

use App\Formatters\DateFormatter;
use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    const ACCIONES = [
        'A' => 'Alta',
        'B' => 'Baja',
        'M' => 'Modificacion',
        'I' => 'Login',
        'O' => 'Logout'
    ];

    protected $table = 'auditorias';

    protected $primaryKey = 'auditoria';

    protected $fillable = [
        'fecha_registro',
        'tabla',
        'accion',
        'descripcion',
    ];

    public $timestamps = false;

    protected $dates = [
        'fecha_registro',
    ];


    public function getFechaRegistroAttribute($fecha_registro)
    {
        return new DateFormatter($fecha_registro);
    }
}
