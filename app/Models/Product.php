<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'productID';

    protected $fillable = [
        'productcategoryID', 'productname', 'productdesc', 'productbuyprice', 
        'productsaleprice', 'productinitquantity', 'productquantity', 
        'create_date', 'modify_date', 'create_userID', 'create_usertypeID'
    ];
}
