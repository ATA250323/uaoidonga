<?php

namespace App\Models;

use App\Traits\HasPublicId;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Information
 *
 * @property $id
 * @property $public_id
 * @property $histoirar
 * @property $histoirfr
 * @property $raisonar
 * @property $raisonfr
 * @property $inforganisaar
 * @property $inforganisafr
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Information extends Model
{
    use HasPublicId;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['public_id', 'histoirar', 'histoirfr', 'raisonar', 'raisonfr', 'inforganisaar', 'inforganisafr'];


}
