<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hmember extends Model
{
    protected $table = 'hmember';
    protected $primaryKey = 'hmemberID';

    protected $fillable = [
        'hostelID', 'categoryID', 'studentID', 'hbalance', 'hjoindate'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'studentID', 'studentID');
    }

    public function hostel()
    {
        return $this->belongsTo(Hostel::class, 'hostelID', 'hostelID');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryID', 'categoryID');
    }
}
