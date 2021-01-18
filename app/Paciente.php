<?php

namespace App;

use App\Formatters\DateFormatter;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    const PACIENTE_MASCULINO = 'm';
    const PACIENTE_FEMENINO = 'f';

    const PACIENTE_ESTADO_CIVIL = [
        '0' => 'Soltero/a',
        '1' => 'Casado/a',
        '2' => 'Viudo/a',
        '3' => 'Unido/a',
        '4' => 'Separado/a',
        '4' => 'Divorciado/a',
        '4' => 'No aplica',
        '4' => 'Se desconoce',
    ];

    const PACIENTE_TIPO_LUGAR = [
        '0' => 'Institucional',
        '1' => 'Domiciliario',
        '2' => 'Otro'
    ];

    const PACIENTE_TIPO_DOCUMENTO = [
        '0' => 'C.Identidad',
        '1' => 'Pasaporte',
        '2' => 'No porta',
        '3' => 'No tiene',
        '4' => 'No se conoce',
    ];

    const PACIENTE_ETNIA = [
        '0' => 'No Aplica',
        '1' => 'Aplica',
    ];

    const PACIENTE_AREA = [
        '0' => 'Urbana',
        '1' => 'Rural',
    ];

    const PACIENTE_SITUACION_LABORAL = [
        '0' => 'No Aplica',
        '1' => 'Trabaja',
        '2' => 'No Trabaja',
    ];

    protected $table = 'pacientes';

    protected $primaryKey = 'paciente';

    protected $fillable = [
        'establecimiento',
        'fecha_ingreso',
        'tipo_documento',
        'numero_documento',
        'nombres',
        'fecha_nacimiento',
        'sexo',
        'lugar_nacimiento',
        'tipo_lugar',
        'nacionalidad',
        'etnia',
        'nombre_etnia',
        'estado_civil',
        'barrio',
        'area',
        'sector',
        'manzana',
        'direccion',
        'nro_casa',
        'referencia',
        'telefono',
        'correo_electronico',
        'nivel_educativo',
        'seguro',
        'profesion',
        'situacion_laboral',
        'ocupacion',
        'nombre_padre',
        'nombre_madre',
    ];

    public $timestamps = false;

    protected $dates = [
        'fecha_ingreso',
        'fecha_nacimiento',
    ];

    public function establecimiento()
    {
        return $this->belongsTo(Establecimiento::class, 'establecimiento', 'establecimiento');
    }

    public function nacionalidad()
    {
        return $this->belongsTo(Nacionalidad::class, 'nacionalidad', 'nacionalidad');
    }

    public function barrio()
    {
        return $this->belongsTo(Barrio::class, 'barrio', 'barrio');
    }

    public function nivelEducativo()
    {
        return $this->belongsTo(NivelEducativo::class, 'nivel_educativo', 'nivel_educativo');
    }

    public function seguro()
    {
        return $this->belongsTo(Seguro::class, 'seguro', 'seguro');
    }

    public function profesion()
    {
        return $this->belongsTo(Profesion::class, 'profesion', 'profesion');
    }

    public function getSexos()
    {
        return $sexos = [
            'masculino' => Paciente::PACIENTE_MASCULINO,
            'femenino' => Paciente::PACIENTE_FEMENINO,
        ];
    }

    public function getFechaIngresoAttribute($fecha_ingreso)
    {
        return new DateFormatter($fecha_ingreso);
    }

    public function getFechaNacimientoAttribute($fecha_nacimiento)
    {
        return new DateFormatter($fecha_nacimiento);
    }
}
