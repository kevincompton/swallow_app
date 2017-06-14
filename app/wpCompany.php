<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class wpCompany extends Model
{
    protected $connection = 'wordpress';
    protected $table = 'wp_posts';

    protected $fillable = [
        'post_title', 'post_type'
    ];

    public function scopeCompanies($query)
    {
        return $query->where('post_type', '=', 'company');
    }

    public function products()
    {
        $products = DB::connection('wordpress')->table('wp_postmeta')
            ->where('meta_key', 'company')
            ->where('meta_value', $this->ID)
            ->select('post_id')
            ->get();

        return $products;
    }

}
