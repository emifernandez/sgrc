<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    protected $table = 'distritos';

    protected $primaryKey = 'distrito';

    protected $fillable = [
        'region',
        'nombre'
    ];


    public $timestamps = false;

    public function region()
    {
        return $this->belongsTo(Region::class, 'region', 'region');
    }

    public function barrios()
    {
        return $this->hasMany(Barrio::class, 'distrito', 'distrito');
    }
}
