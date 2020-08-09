<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $table = 'tipos';

    protected $primaryKey = 'tipo';

    protected $fillable = [
        'nivel',
        'nombre'
    ];


    public $timestamps = false;

    public function nivel()
    {
        return $this->belongsTo(NivelAtencion::class, 'nivel', 'nivel');
    }

    public function establecimientos()
    {
        return $this->hasMany(Establecimiento::class, 'tipo', 'tipo');
    }

    public function setNombreAttribute($nombre) {
        $this->attributes['nombre'] = mb_strtolower($nombre, "UTF-8");

    }

    public function getNombreAttribute($nombre) {
        return mb_convert_case($nombre, MB_CASE_TITLE, "UTF-8");
    }
}
