<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EspecialidadMedica extends Model
{
    protected $table = 'especialidades_medicas';

    protected $primaryKey = 'especialidad';

    protected $fillable = [
        'nombre'
    ];

    public $timestamps = false;

    public function setNombreAttribute($nombre) {
        $this->attributes['nombre'] = mb_strtolower($nombre, "UTF-8");

    }

    public function getNombreAttribute($nombre) {
        return mb_convert_case($nombre, MB_CASE_TITLE, "UTF-8");
    }
}
