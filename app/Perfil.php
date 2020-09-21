<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class Perfil extends Model
{
    protected $table = 'perfiles';

    protected $primaryKey = 'perfil';

    protected $fillable = [
        'nombre'
    ];

    public $timestamps = false;

    public function setNombreAttribute($nombre)
    {
        $this->attributes['nombre'] = mb_strtolower($nombre, "UTF-8");
    }

    public function getNombreAttribute($nombre)
    {
        return ucwords($nombre);
    }

    public function permisos()
    {
        return $this->hasMany(Permiso::class, 'perfil', 'perfil');
    }
}
