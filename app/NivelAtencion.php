<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NivelAtencion extends Model
{
    protected $table = 'niveles_atencion';

    protected $primaryKey = 'nivel';

    protected $fillable = [
        'nombre'
    ];

    public $timestamps = false;

    public function tipos()
    {
        return $this->hasMany(Tipo::class, 'nivel', 'nivel');
    }

    public function setNombreAttribute($nombre) {
        $this->attributes['nombre'] = mb_strtolower($nombre, "UTF-8");

    }

    public function getNombreAttribute($nombre) {
        return mb_convert_case($nombre, MB_CASE_TITLE, "UTF-8");
    }
}
