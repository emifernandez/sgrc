<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NivelEducativo extends Model
{
    protected $table = 'niveles_educativos';

    protected $primaryKey = 'nivel_educativo';

    protected $fillable = [
        'nombre'
    ];

    public $timestamps = false;

    // public function pacientes()
    // {
    //     return $this->hasMany(Distrito::class, 'region', 'region');
    // }

    public function setNombreAttribute($nombre)
    {
        $this->attributes['nombre'] = mb_strtolower($nombre, "UTF-8");
    }

    public function getNombreAttribute($nombre)
    {
        return mb_convert_case($nombre, MB_CASE_TITLE, "UTF-8");
    }
}
