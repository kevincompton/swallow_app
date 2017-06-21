<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class wpCompany extends Model
{
    public $timestamps = false;
    protected $connection = 'wordpress';
    protected $table = 'wp_posts';

    protected $fillable = [
        'post_title', 'post_type', 'post_content', 'post_excerpt', 'to_ping', 'pinged', 'post_content_filtered', 'post_date', 'post_date_gmt', 'post_modified', 'post_modified_gmt'
    ];

    public function scopeCompanies($query)
    {
        return $query->where('post_type', '=', 'company');
    }

    public function scopeDispensaries($query)
    {
        return $query->where('post_type', '=', 'dispensary');
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
