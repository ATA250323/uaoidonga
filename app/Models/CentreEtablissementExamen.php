<?php

namespace App\Models;

use App\Traits\HasPublicId;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CentreEtablissementExamen
 *
 * @property $id
 * @property $public_id
 * @property $centre_id
 * @property $etablissement_id
 * @property $categorie_examen_id
 * @property $anneescolaire_id
 * @property $created_at
 * @property $updated_at
 *
 * @property CategoriesExamen $categoriesExamen
 * @property Centre $centre
 * @property Etablissement $etablissement
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CentreEtablissementExamen extends Model
{
    use HasPublicId;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['public_id', 'centre_id', 'etablissement_id', 'categorie_examen_id','anneescolaire_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoriesExamen()
    {
        return $this->belongsTo(\App\Models\CategoriesExamen::class, 'categorie_examen_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function centre()
    {
        return $this->belongsTo(\App\Models\Centre::class, 'centre_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function etablissement()
    {
        return $this->belongsTo(\App\Models\Etablissement::class, 'etablissement_id', 'id');
    }
     public function anneeScolaire()
    {
        return $this->belongsTo(\App\Models\AnneeScolaire::class, 'anneescolaire_id', 'id');
    }

}
