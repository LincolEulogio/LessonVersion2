<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productsupplier extends Model
{
    protected $table = 'productsupplier';
    protected $primaryKey = 'productsupplierID';

    protected $fillable = [
        'productsuppliername', 'productsuppliercompanyname', 
        'productsupplierphone', 'productsupplieremail', 
        'productsupplieraddress', 'create_date', 'modify_date', 
        'create_userID', 'create_usertypeID'
    ];
}
