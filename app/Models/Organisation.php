<?php

namespace App\Models;

use App\Traits\HasPublicId;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Organisation
 *
 * @property $id
 * @property $public_id
 * @property $titre
 * @property $image
 * @property $description
 * @property $anneescolaire_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Evennement[] $evennements
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Organisation extends Model
{
    use HasPublicId;
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['public_id', 'titre', 'image', 'description','anneescolaire_id'];

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
    
    public function evennements()
    {
        return $this->hasMany(\App\Models\Evennement::class, 'id', 'organisation_id');
    }
    
}
