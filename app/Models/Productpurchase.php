<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productpurchase extends Model
{
    protected $table = 'productpurchase';
    protected $primaryKey = 'productpurchaseID';

    protected $fillable = [
        'productsupplierID', 'productpurchasereferenceno', 'productpurchasedate', 
        'productpurchasedesc', 'productpurchasegrandtotal', 
        'productpurchasepaidamount', 'productpurchaserefundpaymentamount', 
        'productpurchasestatus', 'productpurchasestep', 'create_date', 
        'modify_date', 'create_userID', 'create_usertypeID'
    ];
}
