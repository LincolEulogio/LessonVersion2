<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';
    protected $primaryKey = 'mediaID';

    protected $fillable = [
        'userID', 'usertypeID', 'm_name', 'file_name', 'file_type', 'create_date', 'mcategoryID'
    ];

    public function category()
    {
        return $this->belongsTo(MediaCategory::class, 'mcategoryID', 'media_categoryID');
    }

    public function shares()
    {
        return $this->hasMany(MediaShare::class, 'mediaID', 'mediaID'); // Legacy mapping might be tricky if using item_id
    }
}
