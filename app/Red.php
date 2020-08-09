<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Red extends Model
{
    protected $table = 'redes';

    protected $primaryKey = 'red';

    protected $fillable = [
        'nombre'
    ];

    public $timestamps = false;

    public function establecimientos()
    {
        return $this->hasMany(Establecimiento::class, 'red', 'red');
    }

    public function setNombreAttribute($nombre) {
        $this->attributes['nombre'] = mb_strtolower($nombre, "UTF-8");

    }

    public function getNombreAttribute($nombre) {
        return mb_convert_case($nombre, MB_CASE_TITLE, "UTF-8");
    }
}
