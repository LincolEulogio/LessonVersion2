<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productpurchaseitem extends Model
{
    protected $table = 'productpurchaseitem';
    protected $primaryKey = 'productpurchaseitemID';

    protected $fillable = [
        'productpurchaseID', 'productID', 'productpurchaseitemquantity', 
        'productpurchaseitemunitprice', 'create_date', 'modify_date', 
        'create_userID', 'create_usertypeID'
    ];
}
