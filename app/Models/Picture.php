<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'pictureable_id',
        'pictureable_type',
        'url',
    ];


    
    public function imageable(){
        return $this->morphTo();
    }
}
