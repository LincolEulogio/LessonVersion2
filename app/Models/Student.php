<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'students';
    protected $primaryKey = 'studentID';

    protected $fillable = [
        'name', 'dob', 'sex', 'religion', 'email', 'phone', 
        'address', 'classesID', 'sectionID', 'roll', 'library', 
        'hostel', 'transport', 'create_date', 'modify_date', 
        'create_userID', 'create_username', 'create_usertype', 
        'active', 'username', 'password', 'usertypeID', 'photo'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function classes()
    {
        return $this->belongsTo(Classes::class, 'classesID', 'classesID');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'sectionID', 'sectionID');
    }

    public function parent()
    {
        return $this->belongsTo(Parents::class, 'parentID', 'parentsID');
    }

    public function marks()
    {
        return $this->hasMany(Mark::class, 'studentID', 'studentID');
    }
}
