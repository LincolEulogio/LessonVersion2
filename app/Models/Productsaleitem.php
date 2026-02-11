<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productsaleitem extends Model
{
    protected $table = 'productsaleitem';
    protected $primaryKey = 'productsaleitemID';

    protected $fillable = [
        'productsaleID', 'productID', 'productsaleitemquantity', 
        'productsaleitemunitprice', 'create_date', 'modify_date', 
        'create_userID', 'create_usertypeID'
    ];
}
