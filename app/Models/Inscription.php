<?php

namespace App\Models;

use App\Traits\HasPublicId;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Inscription
 *
 * @property $id
 * @property $public_id
 * @property $matricule
 * @property $nom
 * @property $sexe
 * @property $niveau
 * @property $image
 * @property $etablissement_id
 * @property $anneescolaire_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Anneescolaire $anneescolaire
 * @property Etablissement $etablissement
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Inscription extends Model
{
    use HasPublicId;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['public_id', 'matricule', 'nom', 'sexe', 'niveau','image','etablissement_id', 'anneescolaire_id'];


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
    public function etablissement()
    {
        return $this->belongsTo(\App\Models\Etablissement::class, 'etablissement_id', 'id');
    }

}
