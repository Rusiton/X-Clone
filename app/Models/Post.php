<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'text',
        'profile_id',
    ];


    // Returns the profile that owns this post
    public function profile(){
        return $this->belongsTo(Profile::class);
    }

    // Returns the picture inside the post
    public function picture(){
        return $this->morphOne(Picture::class, 'pictureable');
    }

    // Returns the tags that this post owns
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    // Returns the comments that this post owns
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    
    // Returns all likes that this post owns
    public function likes(){
        return $this->hasMany(Like::class);
    }

    // Returns all repost that this post owns
    public function reposts(){
        return $this->hasMany(Repost::class);
    }

    // Returns all mentions that this post owns
    public function mentions(){
        return $this->hasMany(Mention::class);
    }

    // Returns all reports that this post owns
    public function reports(){
        return $this->morphMany(Report::class, 'reportable');
    }
}
