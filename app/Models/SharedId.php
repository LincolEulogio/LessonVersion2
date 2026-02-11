<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SharedId extends Model
{
    protected $table = 'shared_id';
    protected $primaryKey = 'id';

    protected $fillable = [
        'shared_id'
    ];
}
