<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoice';
    protected $primaryKey = 'invoiceID';

    protected $fillable = [
        'schoolyearID', 'classesID', 'studentID', 'feetypesID', 'feetypes', 
        'amount', 'discount', 'paidamount', 'status', 'date', 
        'create_date', 'day', 'month', 'year', 'paidstatus', 
        'userID', 'usertypeID', 'uname'
    ];
}
