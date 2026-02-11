<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaShare extends Model
{
    protected $table = 'media_share';
    protected $primaryKey = 'media_shareID';

    protected $fillable = [
        'mediaID', 'share_userID', 'share_usertypeID', 'create_date',
        'classesID', 'public', 'file_or_folder', 'item_id'
    ];
}
