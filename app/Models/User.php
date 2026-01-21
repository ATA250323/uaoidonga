<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use App\Traits\HasPublicId;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles,HasFactory, Notifiable,HasPublicId;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_id',
        'last_activity' => 'datetime', // ✅ TRÈS IMPORTANT
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


     public function profilsuer()
    {
        return $this->hasOne(Profil::class);
    }

    public function etablissements()
    {
        return $this->belongsToMany(
            Etablissement::class,
            'user_etablissements',
            'user_id',
            'etablissement_id'
        );
}

public function isOnline()
{
    return $this->last_activity && $this->last_activity >= now()->subMinutes(2);
}

public function offlineSince(): ?string
{
    if (!$this->last_activity) {
        return null;
    }

    if ($this->isOnline()) {
        return null;
    }

    return Carbon::parse($this->last_activity)->diffForHumans();
}


}
