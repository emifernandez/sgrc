<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table = 'consultas_ordenes';

    protected $primaryKey = ['consulta', 'item'];
    public $incrementing = false;

    protected $fillable = [
        'orden'
    ];

    public $timestamps = false;

    public function consulta()
    {
        return $this->belongsTo(RegistroConsulta::class, 'consulta', 'consulta');
    }
}
