<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    protected $table = 'distritos';

    protected $primaryKey = 'distrito';

    protected $fillable = [
        'region',
        'nombre'
    ];


    public $timestamps = false;

    public function region()
    {
        return $this->belongsTo(Region::class, 'region', 'region');
    }

    public function barrios()
    {
        return $this->hasMany(Barrio::class, 'distrito', 'distrito');
    }

    public function setNombreAttribute($nombre) {
        $this->attributes['nombre'] = mb_strtolower($nombre, "UTF-8");

    }

    public function getNombreAttribute($nombre) {
        return mb_convert_case($nombre, MB_CASE_TITLE, "UTF-8");
    }
}
