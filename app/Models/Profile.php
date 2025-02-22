<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'biography',
        'private',
        'user_id',
    ];


    
    // Returns the user that owns this profile
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Returns the picture that his profile owns
    public function picture(){
        return $this->morphOne(Picture::class, 'pictureable');
    }

    // Returns all mentions that this profile owns
    public function mentions(){
        return $this->hasMany(Mention::class);
    }
}
