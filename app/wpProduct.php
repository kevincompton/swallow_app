<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class wpProduct extends Model
{

    protected $connection = 'wordpress';
    protected $table = 'wp_posts';

    public function scopeProducts($query)
    {
        return $query->where('post_type', '=', 'product');
    }
      
    public function companies()
    {
      return $this->belongsToMany('App\wpCompany', 'wp_postmeta', 'meta_value', 'post_id');
    }

}
