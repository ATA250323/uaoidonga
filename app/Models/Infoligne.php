<?php

namespace App\Models;

use App\Traits\HasPublicId;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Infoligne
 *
 * @property $id
 * @property $public_id
 * @property $nom
 * @property $email
 * @property $phone
 * @property $project
 * @property $subjet
 * @property $message
 * @property $lire
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Infoligne extends Model
{
    use HasPublicId;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['public_id', 'nom', 'email', 'phone', 'project', 'subjet', 'message', 'lire'];


}
