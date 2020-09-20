<?php

namespace App;

use App\Formatters\DateFormatter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    const USUARIO_ACTIVO = '1';
    const USUARIO_INACTIVO = '2';

    protected $table = 'usuarios';

    protected $primaryKey = 'usuario';

    protected $fillable = [
        'usuario',
        'funcionario',
        'clave',
        'fecha_registro',
        'fecha_validez',
        'perfil',
        'estado',
    ];

    protected $hidden = [
        'clave',
    ];

    public $timestamps = false;

    protected $dates = [
        'fecha_registro',
        'fecha_validez',
    ];

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'funcionario', 'funcionario');
    }

    public function getEstados()
    {
        return $estados = [
            'Activo' => Usuario::USUARIO_ACTIVO,
            'Inactivo' => Usuario::USUARIO_INACTIVO,
        ];
    }

    public function getFechaRegistroAttribute($fecha_registro)
    {
        return new DateFormatter($fecha_registro);
    }

    public function getFechaValidezAttribute($date)
    {
        return new DateFormatter($date);
    }


    public function setUsuarioAttribute($usuario)
    {
        $this->attributes['usuario'] = mb_strtolower($usuario, "UTF-8");
    }

    public function getUsuarioAttribute($usuario)
    {
        return $usuario;
    }

    public function getAuthPassword()
    {
        return $this->attributes['clave'];
    }
}
