<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Formatters\DateFormatter;

class Derivacion extends Model
{
    const TIPO_DERIVACION = [
        '1' => 'Referencia',
        '2' => 'Contrarreferencia',
    ];

    const PRIORIDAD_DERIVACION = [
        '1' => 'Baja',
        '2' => 'Media',
        '3' => 'Alta',
    ];

    const DERIVACION_ESTADO = [
        '1' => 'Pendiente',
        '2' => 'Finalizado',
    ];

    protected $table = 'derivaciones';

    protected $primaryKey = 'derivacion';

    protected $fillable = [
        'establecimiento',
        'establecimiento_derivacion',
        'contra_derivacion',
        'paciente',
        'profesional_derivante',
        'profesional_derivado',
        'especialidad',
        'cie_derivacion',
        'consulta',
        'motivo',
        'fecha',
        'tipo',
        'descripcion_caso',
        'impresion_diagnostica',
        'tratamiento_actual',
        'recomendacion',
        'situacion_sociofamiliar',
        'usuario',
        'estado',
        'prioridad',
    ];

    public $timestamps = false;

    protected $dates = [
        'fecha',
    ];

    public function establecimiento()
    {
        return $this->belongsTo(Establecimiento::class, 'establecimiento', 'establecimiento');
    }

    public function establecimiento_derivacion()
    {
        return $this->belongsTo(Establecimiento::class, 'establecimiento_derivacion', 'establecimiento');
    }

    public function contra_derivacion()
    {
        return $this->belongsTo(Derivacion::class, 'contra_derivacion', 'derivacion');
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente', 'paciente');
    }

    public function profesional_derivante()
    {
        return $this->belongsTo(Funcionario::class, 'profesional_derivante', 'funcionario');
    }

    public function profesional_derivado()
    {
        return $this->belongsTo(Funcionario::class, 'profesional_derivado', 'funcionario');
    }

    public function especialidad()
    {
        return $this->belongsTo(EspecialidadMedica::class, 'especialidad', 'especialidad');
    }

    public function cie_derivacion()
    {
        return $this->belongsTo(Enfermedad::class, 'enfermedad', 'enfermedad');
    }

    public function consulta()
    {
        return $this->belongsTo(RegistroConsulta::class, 'consulta', 'consulta');
    }

    public function getFechaAttribute($fecha)
    {
        return new DateFormatter($fecha);
    }
}
