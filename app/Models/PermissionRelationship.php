<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionRelationship extends Model
{
    protected $table = 'permission_relationships';
    protected $primaryKey = 'permission_relationshipID';

    protected $fillable = [
        'usertypeID', 'permissionID'
    ];
}
