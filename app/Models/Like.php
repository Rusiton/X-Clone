<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
    ];

    // Return the user that owns this like
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Returns the post that owns this like
    public function post(){
        return $this->belongsTo(Post::class);
    }
}
