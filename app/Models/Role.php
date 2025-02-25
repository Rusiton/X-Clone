<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];


    // Retuns the users that own this role
    public function users(){
        return $this->belongsToMany(User::class);
    }

    // Returns the permissions that this role owns
    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }
}
