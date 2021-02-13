<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HorarioAtencion extends Model
{
    const ESTADOS = [
        '1' => 'Activo',
        '2' => 'Inactivo',
    ];

    const DIAS = [
        '1' => 'Domingo',
        '2' => 'Lunes',
        '3' => 'Martes',
        '4' => 'Miercoles',
        '5' => 'Jueves',
        '6' => 'Viernes',
        '7' => 'Sabado',
    ];

    protected $table = 'horarios_atenciones';

    protected $primaryKey = 'horario';

    protected $fillable = [
        'establecimiento',
        'especialidad',
        'funcionario',
        'dia',
        'hora_desde',
        'hora_hasta',
        'estado',
        'observacion',
        'capacidad_atencion',
        'uso_atencion',
    ];

    public $timestamps = false;

    protected $dates = [
        'hora_desde',
        'hora_hasta',
    ];

    public function establecimiento()
    {
        return $this->belongsTo(Establecimiento::class, 'establecimiento', 'establecimiento');
    }

    public function especialidad()
    {
        return $this->belongsTo(EspecialidadMedica::class, 'especialidad', 'especialidad');
    }

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'funcionario', 'funcionario');
    }

    public function getHoraDesdeAttribute($hora_desde)
    {
        return \Carbon\Carbon::createFromFormat('H:i:s', $this->attributes['hora_desde']);
    }

    public function getHoraHastaAttribute()
    {
        return \Carbon\Carbon::createFromFormat('H:i:s', $this->attributes['hora_hasta']);
    }
}
