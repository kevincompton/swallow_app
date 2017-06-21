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
        return $query->where('deactivate', '==', 0);
    }

    public function scopeImage($query)
    {
        return $query->where('image', '!=', 'empty');
    }

    public function scopeDeactivated($query)
    {
        return $query->where('deactivate', '==', 1);
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
    
}
