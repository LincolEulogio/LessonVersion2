<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = 'site';
    protected $primaryKey = 'siteID';

    protected $fillable = [
        'title', 'tagline', 'email', 'phone', 'address', 'footer', 
        'logo', 'favicon', 'currency_code', 'currency_symbol', 
        'google_analytics', 'language', 'automation', 'create_date', 
        'modify_date', 'create_userID', 'create_usertypeID'
    ];
}
