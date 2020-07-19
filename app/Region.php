<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regiones';

    protected $primaryKey = 'region';

    protected $fillable = [
        'nombre'
    ];

    public $timestamps = false;

    public function distritos()
    {
        return $this->hasMany(Distrito::class, 'region', 'region');
    }
}
