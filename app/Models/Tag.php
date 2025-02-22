<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
    ];


    // Returns the posts that own this tag
    public function posts(){
        return $this->belongsToMany(Post::class);
    }
}
