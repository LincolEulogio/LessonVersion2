<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Systemadmin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'systemadmins';
    protected $primaryKey = 'systemadminID';

    protected $fillable = [
        'name', 'dob', 'sex', 'religion', 'email', 'phone', 'address', 
        'jod', 'photo', 'username', 'password', 'usertypeID', 
        'create_date', 'modify_date', 'create_userID', 
        'create_username', 'create_usertype', 'active'
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
}
