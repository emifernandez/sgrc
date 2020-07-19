<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table = 'perfiles';

    protected $primaryKey = 'perfil';

    protected $fillable = [
        'nombre'
    ];

    public $timestamps = false;
}
