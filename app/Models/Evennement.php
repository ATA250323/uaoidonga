<?php

namespace App\Models;

use App\Traits\HasPublicId;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Evennement
 *
 * @property $id
 * @property $public_id
 * @property $titrear
 * @property $titrefr
 * @property $image
 * @property $annee
 * @property $organisation_id
 * @property $anneescolaire_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Organisation $organisation
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Evennement extends Model
{
    use HasPublicId;
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['public_id', 'titrear', 'titrefr', 'image', 'annee', 'organisation_id','anneescolaire_id'];


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
     public function organisation()
    {
        return $this->belongsTo(\App\Models\Organisation::class, 'organisation_id', 'id');
    }
    
}
