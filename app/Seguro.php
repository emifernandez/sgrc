<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seguro extends Model
{
    protected $table = 'seguros';

    protected $primaryKey = 'seguro';

    protected $fillable = [
        'nombre'
    ];

    public $timestamps = false;

    public function pacientes()
    {
        return $this->hasMany(Paciente::class, 'seguro', 'seguro');
    }

    public function setNombreAttribute($nombre)
    {
        $this->attributes['nombre'] = mb_strtolower($nombre, "UTF-8");
    }

    public function getNombreAttribute($nombre)
    {
        return mb_convert_case($nombre, MB_CASE_TITLE, "UTF-8");
    }
}
