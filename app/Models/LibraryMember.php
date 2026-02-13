<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LibraryMember extends Model
{
    protected $table = 'lmember';
    protected $primaryKey = 'lmemberID';

    protected $fillable = [
        'lmembercardID', 'studentID', 'name', 'email', 'phone', 'lbalance', 'ljoindate'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'studentID', 'studentID');
    }
}
