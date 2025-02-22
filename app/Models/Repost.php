<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repost extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
    ];
    
    // Return the user that owns this mention
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Returns the post that owns this mention
    public function post(){
        return $this->belongsTo(Post::class);
    }
}
