<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barrio extends Model
{
    protected $table = 'barrios';

    protected $primaryKey = 'barrio';

    protected $fillable = [
        'distrito',
        'nombre'
    ];


    public $timestamps = false;

    public function distrito()
    {
        return $this->belongsTo(Distrito::class, 'distrito', 'distrito');
    }

    public function establecimientos()
    {
        return $this->hasMany(Establecimiento::class, 'barrio', 'barrio');
    }

    public function setNombreAttribute($nombre) {
        $this->attributes['nombre'] = mb_strtolower($nombre, "UTF-8");

    }

    public function getNombreAttribute($nombre) {
        return ucwords($nombre);
    }
}
