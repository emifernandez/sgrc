<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicioMedico extends Model
{
    const SERVICIO_MEDICO_ACTIVO = '1';
    const SERVICIO_MEDICO_INACTIVO = '2';

    protected $table = 'servicios_medicos';

    protected $primaryKey = 'servicio';

    protected $fillable = [
        'nombre',
        'estado',
    ];

    public $timestamps = false;

    public function getEstados()
    {
        return $estados = [
            'Activo' => ServicioMedico::SERVICIO_MEDICO_ACTIVO,
            'Inactivo' => ServicioMedico::SERVICIO_MEDICO_INACTIVO,
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
