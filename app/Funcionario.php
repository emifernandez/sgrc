<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    const FUNCIONARIO_ACTIVO = '1';
    const FUNCIONARIO_INACTIVO = '2';

    const FUNCIONARIO_MASCULINO = 'm';
    const FUNCIONARIO_FEMENINO = 'f';

    protected $table = 'funcionarios';

    protected $primaryKey = 'funcionario';

    protected $fillable = [
        'nombres',
        'apellidos',
        'cedula_identidad',
        'direccion',
        'barrio',
        'fecha_nacimiento',
        'sexo',
        'telefono_principal',
        'telefono_secundario',
        'profesion',
        'registro_profesional',
        'cargo',
        'especialidad',
        'email',
        'estado',
    ];

    public $timestamps = false;

    public function barrio()
    {
        return $this->belongsTo(Barrio::class, 'barrio', 'barrio');
    }

    public function profesion()
    {
        return $this->belongsTo(Profesion::class, 'profesion', 'profesion');
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'cargo', 'cargo');
    }

    public function especialidad()
    {
        return $this->belongsTo(EspecialidadMedica::class, 'especialidad', 'especialidad');
    }

    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'funcionario', 'funcionario');
    }

    public function getEstados()
    {
        return $estados = [
            'Activo' => Funcionario::FUNCIONARIO_ACTIVO,
            'Inactivo' => Funcionario::FUNCIONARIO_INACTIVO,
        ];
    }

    public function getSexos()
    {
        return $sexos = [
            'masculino' => Funcionario::FUNCIONARIO_MASCULINO,
            'femenino' => Funcionario::FUNCIONARIO_FEMENINO,
        ];
    }
}
