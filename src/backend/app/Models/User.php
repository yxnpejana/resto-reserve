<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'email', 'password', 'user_status_id', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Formats the URL for the user avatar
     *
     * @return string
     */
    public function getAvatarAttribute($value)
    {
        return (strlen($value)) ? sprintf('%s/%s', config('app.asset_url'), $value) : null;
    }

    /**
     * Retrieves all activation tokens of the user
     *
     * @return App\Models\ActivationToken[]
     */
    public function activationTokens()
    {
        return $this->hasMany(ActivationToken::class);
    }

    /**
     * Retrieves the Status of the User
     *
     * @return App\Models\UserStatus
     */
    public function status()
    {
        return $this->belongsTo(UserStatus::class, 'user_status_id');
    }
}
