<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicacion extends Model
{
    protected $table = 'consultas_indicaciones';

    protected $primaryKey = ['consulta', 'item'];
    public $incrementing = false;

    protected $fillable = [
        'indicacion'
    ];

    public $timestamps = false;

    public function consulta()
    {
        return $this->belongsTo(RegistroConsulta::class, 'consulta', 'consulta');
    }
}
