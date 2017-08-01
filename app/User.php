<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'company', 'category', 'email', 'password', 'wordpress_id', 'company_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'admin' => 'boolean'
    ];

    public function isAdmin()
    {
        return $this->admin;
    }

    public function scopePending($query)
    {
        return $query->where('approved', '==', 0);
    }

    public function scopeApproved($query)
    {
        return $query->where('approved', '!=', 0);
    }

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

}
