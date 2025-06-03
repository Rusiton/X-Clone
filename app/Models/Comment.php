<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'post_id',
        'text',
    ];


    // Return the user that owns this comment
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Returns the post that owns this comment
    public function post(){
        return $this->belongsTo(Post::class);
    }
}
