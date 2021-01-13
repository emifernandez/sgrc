<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acceso extends Model
{
    protected $table = 'accesos';

    protected $primaryKey = 'acceso';

    protected $fillable = [
        'nombre',
        'url'
    ];

    public $timestamps = false;

    public function permisos()
    {
        return $this->belongsToMany(Permiso::class, 'permisos_detalles', 'permiso', 'acceso')
            ->withPivot('habilitado')
            ->as('detalle');
    }
}
