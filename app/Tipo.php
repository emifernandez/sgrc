<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $table = 'tipos';

    protected $primaryKey = 'tipo';

    protected $fillable = [
        'nivel',
        'nombre'
    ];


    public $timestamps = false;

    public function nivel()
    {
        return $this->belongsTo(NivelAtencion::class, 'nivel', 'nivel');
    }

    public function establecimientos()
    {
        return $this->hasMany(Establecimiento::class, 'tipo', 'tipo');
    }
}
