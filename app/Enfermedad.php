<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enfermedad extends Model
{
    protected $table = 'enfermedades';

    protected $primaryKey = 'enfermedad';

    protected $fillable = [
        'codigo',
        'descripcion',
    ];

    public $timestamps = false;

    public function consultas()
    {
        return $this->belongsToMany(RegistroConsulta::class, 'consultas_diagnosticos', 'enfermedad', 'enfermedad')
            ->withPivot('observacion')
            ->as('consultas_diagnosticos');
    }

    public function setDescripcionAttribute($descripcion)
    {
        $this->attributes['descripcion'] = mb_strtolower($descripcion, "UTF-8");
    }

    public function getDescripcionAttribute($descripcion)
    {
        return mb_convert_case($descripcion, MB_CASE_TITLE, "UTF-8");
    }
}
