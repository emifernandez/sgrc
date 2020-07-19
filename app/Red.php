<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Red extends Model
{
    protected $table = 'redes';

    protected $primaryKey = 'red';

    protected $fillable = [
        'nombre'
    ];

    public $timestamps = false;

    public function establecimientos()
    {
        return $this->hasMany(Establecimiento::class, 'red', 'red');
    }
}
