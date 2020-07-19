<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Establecimiento extends Model
{
    const ESTABLECIMIENTO_ACTIVO = '1';
    const ESTABLECIMIENTO_INACTIVO = '2';

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

    public function getEstados()
    {
        return $estados = [
            'Activo' => ESTABLECIMIENTO::ESTABLECIMIENTO_ACTIVO,
            'Inactivo' => ESTABLECIMIENTO::ESTABLECIMIENTO_INACTIVO,
        ];
    }
}
