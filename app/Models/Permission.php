<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';
    protected $primaryKey = 'permissionID';

    protected $fillable = ['name', 'description'];

    public function relationships()
    {
        return $this->hasMany(PermissionRelationship::class, 'permissionID', 'permissionID');
    }
}
