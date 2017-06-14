<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class wpMeta extends Model
{
    
    protected $connection = 'wordpress';
    protected $table = 'wp_postmeta';

}
