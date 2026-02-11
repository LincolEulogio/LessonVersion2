<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaCategory extends Model
{
    protected $table = 'media_category';
    protected $primaryKey = 'media_categoryID';

    protected $fillable = [
        'userID', 'usertypeID', 'folder_name', 'create_date'
    ];

    public function files()
    {
        return $this->hasMany(Media::class, 'mcategoryID', 'media_categoryID');
    }
}
