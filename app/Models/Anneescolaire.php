<?php

namespace App\Models;

use App\Traits\HasPublicId;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Anneescolaire
 *
 * @property $id
 * @property $public_id
 * @property $anneefr
 * @property $anneear
 * @property $created_at
 * @property $updated_at
 *
 * @property Centre[] $centres
 * @property Etablissement[] $etablissements
 * @property Evennement[] $evennements
 * @property Organisation[] $organisations
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Anneescolaire extends Model
{
    use HasPublicId;
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['public_id', 'anneefr', 'anneear'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function centres()
    {
        return $this->hasMany(\App\Models\Centre::class, 'id', 'anneescolaire_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function etablissements()
    {
        return $this->hasMany(\App\Models\Etablissement::class, 'id', 'anneescolaire_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function evennements()
    {
        return $this->hasMany(\App\Models\Evennement::class, 'id', 'anneescolaire_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function organisations()
    {
        return $this->hasMany(\App\Models\Organisation::class, 'id', 'anneescolaire_id');
    }
    
}
