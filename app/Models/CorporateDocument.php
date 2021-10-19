<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CorporateDocument extends Model
{
    protected $table = 'tw_documentos_corporativos';

    protected $fillable =
    [
        'tw_corporativos_id',
        'tw_documentos_id',
        'S_ArchivoUrl',
    ];

    public $timestamps = false;

}
