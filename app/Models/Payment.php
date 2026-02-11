<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';
    protected $primaryKey = 'paymentID';

    protected $fillable = [
        'schoolyearID', 'invoiceID', 'studentID', 'paymentamount', 
        'paymenttype', 'paymentdate', 'paymentday', 'paymentmonth', 
        'paymentyear', 'userID', 'usertypeID', 'uname', 'transactionID', 'notice'
    ];
}
