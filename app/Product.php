<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function scopeActive($query)
    {
        return $query->where('deactivated', '==', 0);
    }

    public function scopeDeactived($query)
    {
        return $query->where('deactivated', '==', 1);
    }
    
}
