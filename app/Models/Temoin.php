<?php

namespace App\Models;

use App\Traits\HasPublicId;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Temoin
 *
 * @property $id
 * @property $public_id
 * @property $image
 * @property $messagear
 * @property $messagefr
 * @property $nom_prenom
 * @property $nom_organe
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Temoin extends Model
{
    use HasPublicId;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['public_id', 'image', 'messagear', 'messagefr', 'nom_prenom', 'nom_organe','status'];


}
temoins
