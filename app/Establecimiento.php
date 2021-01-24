<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Establecimiento extends Model
{
    const ESTABLECIMIENTO_ACTIVO = '1';
    const ESTABLECIMIENTO_INACTIVO = '2';

    const ESTADOS = [
        '1' => 'Activo',
        '2' => 'Inactivo',
    ];

    protected $table = 'establecimientos';

    protected $primaryKey = 'establecimiento';

    protected $fillable = [
        'codigo',
        'nombre',
        'tipo',
        'red',
        'ubicacion',
        'barrio',
        'establecimiento_encargado',
        'telefono1',
        'telefono2',
        'email',
        'latitud',
        'longitud',
        'estado',
        'orden',
    ];

    public $timestamps = false;

    public function tipo()
    {
        return $this->belongsTo(Tipo::class, 'tipo', 'tipo');
    }

    public function red()
    {
        return $this->belongsTo(Red::class, 'red', 'red');
    }

    public function barrio()
    {
        return $this->belongsTo(Barrio::class, 'barrio', 'barrio');
    }

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'usuarios_establecimientos', 'establecimiento', 'usuario');
    }

    public function pacientes()
    {
        return $this->hasMany(Paciente::class, 'establecimiento', 'establecimiento');
    }

    public function getEstados()
    {
        return $estados = [
            'Activo' => ESTABLECIMIENTO::ESTABLECIMIENTO_ACTIVO,
            'Inactivo' => ESTABLECIMIENTO::ESTABLECIMIENTO_INACTIVO,
        ];
    }

    public function setNombreAttribute($nombre)
    {
        $this->attributes['nombre'] = mb_strtolower($nombre, "UTF-8");
    }

    public function getNombreAttribute($nombre)
    {
        return mb_convert_case($nombre, MB_CASE_TITLE, "UTF-8");
    }
}
