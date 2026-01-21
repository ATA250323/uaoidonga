<?php

namespace App\Models;

use App\Traits\HasPublicId;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Apropo
 *
 * @property $id
 * @property $public_id
 * @property $annee
 * @property $aproposar
 * @property $aproposfr
 * @property $missionar
 * @property $missionfr
 * @property $objectifar
 * @property $objectiffr
 * @property $visionar
 * @property $visionfr
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Apropo extends Model
{
    use HasPublicId;
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['public_id', 'annee','aproposar', 'aproposfr', 'missionar', 'missionfr', 'objectifar', 'objectiffr', 'visionar', 'visionfr'];


}
