<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResetPassword extends Model
{
    protected $table = 'reset_password';
    protected $primaryKey = 'reset_passwordID';

    protected $fillable = [
        'email', 'key', 'create_date'
    ];
}
