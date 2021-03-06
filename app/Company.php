<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    protected $fillable = [
        'name', 'wordpress_id', 'category', 'latitude', 'longitude'
    ];
    
    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }

    public function scopeDispensaries($query)
    {
        return $query->where('category', '=', 'dispensary');
    }

    public function scopeEdibles($query)
    {
        return $query->where('category', '=', 'edibles');
    }

}
