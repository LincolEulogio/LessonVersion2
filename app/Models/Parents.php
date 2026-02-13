<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\HasPermissions;

class Parents extends Authenticatable
{
    use HasFactory, Notifiable, HasPermissions;

    protected $table = 'parents';
    protected $primaryKey = 'parentsID';

    protected $fillable = [
        'name', 'father_name', 'mother_name', 'father_profession', 
        'mother_profession', 'email', 'phone', 'address', 'photo', 
        'username', 'password', 'usertypeID', 'dni', 'create_date', 
        'modify_date', 'create_userID', 'create_username', 
        'create_usertype', 'active'
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

    public function students()
    {
        return $this->hasMany(Student::class, 'parentID', 'parentsID');
    }

    public function usertype()
    {
        return $this->belongsTo(Usertype::class, 'usertypeID', 'usertypeID');
    }
}
