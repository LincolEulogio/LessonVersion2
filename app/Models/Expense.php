<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table = 'expense';
    protected $primaryKey = 'expenseID';

    protected $fillable = [
        'create_date', 'date', 'expenseday', 'expensemonth', 'expenseyear', 
        'expense', 'amount', 'userID', 'usertypeID', 'uname', 'schoolyearID', 'note'
    ];
}
