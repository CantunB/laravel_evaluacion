<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CorporateContract extends Model
{
    protected $table = 'tw_contratos_corporativos';

    protected $fillable = [
        'D_FechaFin',
        'S_URLContrato',
        'tw_corporativos_id'
    ];

    public $timestamps = false;

}
