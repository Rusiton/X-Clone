<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'theme',
        'user_id',
    ];



    // Returns the user that owns this setting
    public function user(){
        return $this->belongsTo(User::class);
    }
}
