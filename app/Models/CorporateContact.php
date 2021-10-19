<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CorporateContact extends Model
{
    protected $table = 'tw_contactos_corporativos';

    protected $fillable = [
        'S_Nombre',
        'S_Puesto',
        'S_Comentarios',
        'N_TelefonoFijo',
        'N_TelefonoMovil',
        'S_Email',
        'tw_corporativos_id'
    ];

    public $timestamps = false;

}
