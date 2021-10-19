<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Document extends Model
{
    protected $table = 'tw_documentos';

    protected $fillable = [
        'S_Nombre',
        'N_Obligatorio',
        'S_Descripcion'
    ];

    public $timestamps = false;


    public function doc_cor(): HasMany
    {
        return $this->hasMany(CorporateDocument::class,'tw_documentos_id');
    }
}
