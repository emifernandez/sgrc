<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nacionalidad extends Model
{
    protected $table = 'nacionalidades';

    protected $primaryKey = 'nacionalidad';

    protected $fillable = [
        'nombre'
    ];

    public $timestamps = false;

    public function pacientes()
    {
        return $this->hasMany(Paciente::class, 'nacionalidad', 'nacionalidad');
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
