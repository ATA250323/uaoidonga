<?php

namespace App\Models;

use App\Traits\HasPublicId;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoriesExamen
 *
 * @property $id
 * @property $public_id
 * @property $code
 * @property $libelle
 * @property $created_at
 * @property $updated_at
 *
 * @property Candidat[] $candidats
 * @property CentreEtablissementExamen[] $centreEtablissementExamens
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CategoriesExamen extends Model
{
    use HasPublicId;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['public_id', 'code', 'libelle'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function candidats()
    {
        return $this->hasMany(\App\Models\Candidat::class, 'id', 'categorie_examen_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function centreEtablissementExamens()
    {
        return $this->hasMany(\App\Models\CentreEtablissementExamen::class, 'id', 'categorie_examen_id');
    }

}
