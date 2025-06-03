<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory;
    use SoftDeletes;

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

    // Returns all followers that this profile owns 
    public function followers(){
        return $this->belongsToMany(User::class, 'follows');
    }

    // Returns all posts that this profile owns
    public function posts(){
        return $this->hasMany(Post::class);
    }

    // Returns the most liked posts that this profile owns
    public function topPosts(){
        return $this->posts()->withCount('likes')->orderByDesc('likes_count');
    }

    // Returns all reports that this profile owns
    public function reports(){
        return $this->morphMany(Report::class, 'reportable');
    }
}
