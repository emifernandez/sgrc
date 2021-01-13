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

    // public function pacientes()
    // {
    //     return $this->hasMany(Distrito::class, 'region', 'region');
    // }

    public function setDescripcionAttribute($descripcion)
    {
        $this->attributes['descripcion'] = mb_strtolower($descripcion, "UTF-8");
    }

    public function getDescripcionAttribute($descripcion)
    {
        return mb_convert_case($descripcion, MB_CASE_TITLE, "UTF-8");
    }
}
