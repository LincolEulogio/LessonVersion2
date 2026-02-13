<?php

namespace App\Traits;

use App\Models\Permission;
use App\Models\PermissionRelationship;

trait HasPermissions
{
    public function hasPermission($name)
    {
        // Administrador has total control - see everything
        // check by ID 1 or if it's a Systemadmin model instance
        if ($this->usertypeID == 1 || $this instanceof \App\Models\Systemadmin) {
            return true;
        }

        $permission = Permission::where('name', $name)->first();
        if (!$permission) {
            return false;
        }

        return PermissionRelationship::where('usertypeID', $this->usertypeID)
            ->where('permissionID', $permission->permissionID)
            ->exists();
    }

    public function hasAnyPermission($names)
    {
        if (is_array($names)) {
            foreach ($names as $name) {
                if ($this->hasPermission($name)) return true;
            }
            return false;
        }
        return $this->hasPermission($names);
    }
}
