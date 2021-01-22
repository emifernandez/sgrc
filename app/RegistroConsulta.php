<?php

namespace App;

use App\Formatters\DateFormatter;
use Illuminate\Database\Eloquent\Model;

class RegistroConsulta extends Model
{
    const TIPO_CONSULTA = [
        '1' => 'Externa',
        '2' => 'Urgencia',
        '3' => 'Extramural',
    ];

    protected $table = 'registros_consultas';

    protected $primaryKey = 'consulta';

    protected $fillable = [
        'establecimiento',
        'admision',
        'paciente',
        'profesional',
        'referencia_origen',
        'referencia_destino',
        'fecha',
        'tipo_consulta',
    ];

    public $timestamps = false;

    protected $dates = [
        'fecha',
    ];

    public function motivos()
    {
        return $this->belongsToMany(Motivo::class, 'consultas_motivos', 'consulta', 'consulta')
            ->withPivot('descripcion')
            ->as('consultas_motivos');
    }

    public function diagnosticos()
    {
        return $this->belongsToMany(Enfermedad::class, 'consultas_diagnosticos', 'consulta', 'consulta')
            ->withPivot('observacion')
            ->as('consultas_diagnosticos');
    }

    public function ordenes()
    {
        return $this->hasMany(Orden::class, 'consulta', 'consulta');
    }

    public function indicaciones()
    {
        return $this->hasMany(Indicacion::class, 'consulta', 'consulta');
    }

    public function establecimiento()
    {
        return $this->belongsTo(Establecimiento::class, 'establecimiento', 'establecimiento');
    }

    public function admision()
    {
        return $this->belongsTo(Admision::class, 'admision', 'admision');
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente', 'paciente');
    }

    public function profesional()
    {
        return $this->belongsTo(Funcionario::class, 'profesional', 'funcionario');
    }

    public function getFechaAttribute($fecha)
    {
        return new DateFormatter($fecha);
    }
}
