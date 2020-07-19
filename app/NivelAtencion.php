<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NivelAtencion extends Model
{
    protected $table = 'niveles_atencion';

    protected $primaryKey = 'nivel';

    protected $fillable = [
        'nombre'
    ];

    public $timestamps = false;

    public function tipos()
    {
        return $this->hasMany(Tipo::class, 'nivel', 'nivel');
    }
}
