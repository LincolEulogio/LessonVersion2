<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productcategory extends Model
{
    protected $table = 'productcategory';
    protected $primaryKey = 'productcategoryID';

    protected $fillable = [
        'productcategoryname', 'productcategorydesc', 'create_date', 
        'modify_date', 'create_userID', 'create_usertypeID'
    ];
}
