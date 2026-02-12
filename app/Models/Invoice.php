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

    public function student()
    {
        return $this->belongsTo(Student::class, 'studentID', 'studentID');
    }

    public function classes()
    {
        return $this->belongsTo(Classes::class, 'classesID', 'classesID');
    }

    public function feetype()
    {
        return $this->belongsTo(Feetype::class, 'feetypesID', 'feetypesID');
    }
}
