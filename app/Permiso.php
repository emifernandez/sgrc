<?php

namespace App;

use App\Formatters\DateFormatter;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $table = 'permisos';

    protected $primaryKey = 'permiso';

    protected $fillable = [
        'perfil',
        'fecha_asignacion'
    ];

    protected $dates = [
        'fecha_asignacion',
    ];

    public $timestamps = false;

    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'perfil', 'perfil');
    }

    public function accesos()
    {
        return $this->belongsToMany(Acceso::class, 'permisos_detalles', 'permiso', 'acceso')
            ->withPivot('habilitado')
            ->as('detalle');
    }

    public function getFechaAsignacionAttribute($fecha_asignacion)
    {
        return new DateFormatter($fecha_asignacion);
    }
}
