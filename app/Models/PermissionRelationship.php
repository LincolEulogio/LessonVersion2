<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionRelationship extends Model
{
    use HasFactory;

    protected $table = 'permission_relationships';
    protected $primaryKey = 'permission_relationshipID';

    protected $fillable = ['usertypeID', 'permissionID'];

    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permissionID', 'permissionID');
    }

    public function usertype()
    {
        return $this->belongsTo(Usertype::class, 'usertypeID', 'usertypeID');
    }
}
