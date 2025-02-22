<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    

    // Returns user's profile
    public function profile(){
        return $this->hasOne(Profile::class);
    }

    // Returns all user's roles
    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    // Returns all comments that this user owns
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    // Returns all likes that this user owns
    public function likes(){
        return $this->hasMany(Like::class);
    }

    // Returns all repost that this user owns
    public function reposts(){
        return $this->hasMany(Repost::class);
    }
}
