<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;

use Illuminate\Foundation\Auth\User as Authenticatable;


#[Fillable(["name", "email", "password"])]
class User extends Authenticatable
{
    public function reviews() {
        return $this->hasMany(Review::class);
    }
    
}
