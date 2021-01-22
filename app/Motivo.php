<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Motivo extends Model
{
    protected $table = 'motivos';

    protected $primaryKey = 'motivo';

    protected $fillable = [
        'descripcion'
    ];

    public $timestamps = false;

    public function consultas()
    {
        return $this->belongsToMany(RegistroConsulta::class, 'consultas_motivos', 'motivo', 'motivo')
            ->withPivot('descripcion')
            ->as('consultas_motivos');
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
