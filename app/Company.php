<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    
    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }

}
