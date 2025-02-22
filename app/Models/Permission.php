<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name',
    ];


    
    // Returns the roles that own this permission
    public function roles(){
        return $this->belongsToMany(Role::class);
    }
}
