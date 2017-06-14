<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WordpressUser extends Model
{
    protected $connection = 'wordpress';
    protected $table = 'wp_posts';

    public function scopeCompanies($query)
    {
        return $query->where('post_type', '=', 'company');
    }

    public function scopeDispensaries($query)
    {
        return $query->where('post_type', '=', 'dispensary');
    }
}
