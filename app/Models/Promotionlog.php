<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotionlog extends Model
{
    protected $table = 'promotionlog';
    protected $primaryKey = 'promotionlogID';

    protected $fillable = [
        'studentID', 'classesID', 'sectionID', 'roll', 'schoolyearID', 
        'promotion_classesID', 'promotion_sectionID', 'promotion_roll', 
        'promotion_schoolyearID', 'create_date', 'create_userID', 'create_usertypeID'
    ];
}
