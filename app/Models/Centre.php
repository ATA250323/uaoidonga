<?php

namespace App\Models;

use App\Traits\HasPublicId;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Centre
 *
 * @property $id
 * @property $public_id
 * @property $nomar
 * @property $nomfr
 * @property $prefixe
 * @property $adresse
 * @property $email
 * @property $telephone
 * @property $anneescolaire_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Anneescolaire $anneescolaire
 * @property Etablissement[] $etablissements
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Centre extends Model
{
    use HasPublicId;
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['public_id', 'nomar', 'nomfr', 'prefixe', 'adresse', 'email', 'telephone', 'anneescolaire_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function anneescolaire()
    {
        return $this->belongsTo(\App\Models\Anneescolaire::class, 'anneescolaire_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function etablissements()
    {
        return $this->hasMany(\App\Models\Etablissement::class, 'id', 'centre_id');
    }
    
}
