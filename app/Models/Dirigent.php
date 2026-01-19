<?php

namespace App\Models;

use App\Traits\HasPublicId;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Dirigent
 *
 * @property $id
 * @property $public_id
 * @property $nom
 * @property $profession
 * @property $facebook
 * @property $whatsapp
 * @property $tiweter
 * @property $email
 * @property $image
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Dirigent extends Model
{
    use HasPublicId;
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['public_id', 'nom', 'profession', 'facebook', 'whatsapp', 'tiweter', 'email', 'image'];


}
