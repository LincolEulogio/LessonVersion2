<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'categoryID';

    protected $fillable = [
        'hostelID', 'class_type', 'hbalance', 'note'
    ];
}
