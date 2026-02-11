<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransportMember extends Model
{
    protected $table = 'tmember';
    protected $primaryKey = 'tmemberID';

    protected $fillable = [
        'studentID', 'transportID', 'tbalance', 'tjoindate'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'studentID', 'studentID');
    }

    public function transport()
    {
        return $this->belongsTo(Transport::class, 'transportID', 'transportID');
    }
}
