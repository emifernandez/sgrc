<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regiones';

    protected $primaryKey = 'region';

    protected $fillable = [
        'nombre'
    ];

    public $timestamps = false;

    public function distritos()
    {
        return $this->hasMany(Distrito::class, 'region', 'region');
    }

    public function setNombreAttribute($nombre) {
        $this->attributes['nombre'] = mb_strtolower($nombre, "UTF-8");

    }

    public function getNombreAttribute($nombre) {
        return mb_convert_case($nombre, MB_CASE_TITLE, "UTF-8");
    }
}
