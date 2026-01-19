<?php

namespace App\Models;

use App\Traits\HasPublicId;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Etablissement
 *
 * @property $id
 * @property $public_id
 * @property $nomarabe
 * @property $nomfrancais
 * @property $prefixe
 * @property $adresse
 * @property $email
 * @property $telephone
 * @property $annee
 * @property $centre_id
 * @property $anneescolaire_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Centre $centre
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Etablissement extends Model
{
    use HasPublicId;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['public_id', 'nomarabe', 'nomfrancais', 'prefixe', 'adresse', 'email', 'telephone', 'annee', 'centre_id','anneescolaire_id'];

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
    public function centre()
    {
        return $this->belongsTo(\App\Models\Centre::class, 'centre_id', 'id');
    }

}
