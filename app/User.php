<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasApiTokens;

    const USUARIO_VERIFICADO = 'verificado';
    const USUARIO_NO_VERIFICADO = 'no verificado';

    const USUARIO_ACTIVO = '1';
    const USUARIO_NO_ACTIVO = '0';


    protected $table = 'tw_usuarios';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'S_Nombre',
        'S_Apellidos',
        'S_FotoPerfilUrl',
        'password',
        'verification_token',
        'verified',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function estaVerificado()
    {
        return $this->verified == User::USUARIO_VERIFICADO;
    }

    public function estaActivo()
    {
        return $this->S_Activo == User::USUARIO_ACTIVO;
    }

    public static function generarVerificationToken()
    {
        return Str::random(40);
    }
}
