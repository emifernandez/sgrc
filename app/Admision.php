<?php

namespace App;

use App\Formatters\DateFormatter;
use Illuminate\Database\Eloquent\Model;

class Admision extends Model
{
    const ADMISION_ESTADO = [
        '1' => 'Pendiente',
        '2' => 'Finalizado',
    ];

    const ADMISION_PRIORIDAD = [
        '1' => 'Baja',
        '2' => 'Normal',
        '3' => 'Alta',
    ];

    protected $table = 'admisiones';

    protected $primaryKey = 'admision';

    protected $fillable = [
        'establecimiento',
        'derivacion',
        'paciente',
        'fecha_admision',
        'especialidad',
        'profesional',
        'servicio',
        'usuario',
        'fecha_registro',
        'estado',
        'prioridad',
        'observacion',
    ];

    public $timestamps = false;

    protected $dates = [
        'fecha_admision',
        'fecha_registro',
    ];

    public function establecimiento()
    {
        return $this->belongsTo(Establecimiento::class, 'establecimiento', 'establecimiento');
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente', 'paciente');
    }

    public function nivelEducativo()
    {
        return $this->belongsTo(EspecialidadMedica::class, 'especialidad', 'especialidad');
    }

    public function profesional()
    {
        return $this->belongsTo(Funcionario::class, 'profesional', 'funcionario');
    }

    public function servicio()
    {
        return $this->belongsTo(ServicioMedico::class, 'servicio', 'servicio');
    }

    public function getFechaAdmisionAttribute($fecha_admision)
    {
        return new DateFormatter($fecha_admision);
    }

    public function getFechaRegistroAttribute($fecha_registro)
    {
        return new DateFormatter($fecha_registro);
    }
}
