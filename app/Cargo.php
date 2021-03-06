<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table = 'cargos';

    protected $primaryKey = 'cargo';

    protected $fillable = [
        'nombre'
    ];

    public $timestamps = false;

    public function funcionarios()
    {
        return $this->hasMany(Funcionario::class, 'cargo', 'cargo');
    }

    public function setNombreAttribute($nombre) {
        $this->attributes['nombre'] = mb_strtolower($nombre, "UTF-8");

    }

    public function getNombreAttribute($nombre) {
        return mb_convert_case($nombre, MB_CASE_TITLE, "UTF-8");
    }
}
