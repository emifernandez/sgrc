<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesion extends Model
{
    protected $table = 'profesiones';

    protected $primaryKey = 'profesion';

    protected $fillable = [
        'nombre'
    ];

    public $timestamps = false;

    public function funcionarios()
    {
        return $this->hasMany(Funcionario::class, 'profesion', 'profesion');
    }

    public function pacientes()
    {
        return $this->hasMany(Paciente::class, 'profesion', 'profesion');
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
