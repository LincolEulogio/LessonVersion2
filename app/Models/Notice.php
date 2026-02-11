<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $table = 'notice';
    protected $primaryKey = 'noticeID';

    protected $fillable = [
        'title', 'notice', 'date', 'create_date'
    ];
}
