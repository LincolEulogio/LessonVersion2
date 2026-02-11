<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'postsID';

    protected $fillable = [
        'title', 'content', 'status', 'create_date', 'modify_date', 'userID', 'usertypeID'
    ];
}
