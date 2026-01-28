<?php

namespace App\Models;

use App\Traits\HasPublicId;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Candidat
 *
 * @property $id
 * @property $public_id
 * @property $nom
 * @property $prenom
 * @property $sexe
 * @property $date_naissance
 * @property $numero_table
 * @property $centre_id
 * @property $etablissement_id
 * @property $anneescolaire_id
 * @property $categorie_examen_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Anneescolaire $anneescolaire
 * @property CategoriesExamen $categoriesExamen
 * @property Centre $centre
 * @property Etablissement $etablissement
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Candidat extends Model
{
    use HasPublicId;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['public_id', 'nom', 'prenom', 'sexe', 'date_naissance', 'numero_table', 'centre_id', 'etablissement_id', 'anneescolaire_id', 'categorie_examen_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function anneescolaire()
    {
        return $this->belongsTo(\App\Models\Anneescolaire::class, 'anneescolaire_id', 'id');
    }

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

}
