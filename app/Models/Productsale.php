<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productsale extends Model
{
    protected $table = 'productsale';
    protected $primaryKey = 'productsaleID';

    protected $fillable = [
        'productsalereferenceno', 'productsalecustomerid', 
        'productsalecustertypeid', 'productsaledate', 'productsaledesc', 
        'productsalegrandtotal', 'productsalepaidamount', 
        'productsalerefundpaymentamount', 'productsalestatus', 
        'productsalestep', 'create_date', 'modify_date', 
        'create_userID', 'create_usertypeID'
    ];
}
