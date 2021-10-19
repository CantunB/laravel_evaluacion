<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Corporate extends Model
{
    use SoftDeletes;

    const CORPORATIVO_ACTIVO = '1';
    const CORPORATIVO_NO_ACTIVO = '0';

    protected $table = 'tw_corporativos';

    protected $fillable = [
        'S_NombreCorto',
        'S_NombreCompleto',
        'S_LogoURL',
        'S_DBName',
        'S_DBUsuario',
        'S_DBPassword',
        'S_SystemUrl',
        'S_Activo',
        'D_FechaIncorporacion',
        'tw_usuarios_id',
        'FK_Asignado_id'
        ];

    public function estaActivo()
    {
        return $this->S_Activo == Corporate::CORPORATIVO_ACTIVO;
    }

    /**
     * Get all of the empresas for the Corporate
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function empresas(): HasMany
    {
        return $this->hasMany(CorporateCompany::class,'tw_corporativos_id');
    }

    /**
     * Get all of the contactos for the Corporate
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contactos(): HasMany
    {
        return $this->hasMany(CorporateContact::class,'tw_corporativos_id');
    }

    /**
     * Get all of the contratos for the Corporate
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contratos(): HasMany
    {
        return $this->hasMany(CorporateContract::class,'tw_corporativos_id');
    }

    /**
     * Get all of the documentos for the Corporate
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documentos(): HasMany
    {
        return $this->hasMany(CorporateDocument::class,'tw_corporativos_id');
    }
}
