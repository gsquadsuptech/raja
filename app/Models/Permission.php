<?php

namespace App\Models;

use App\Models\Roles;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    
    public function roles() {
        return $this->belongsToMany(Roles::class, 'roles_permissions', 'permission_id', 'role_id')->withPivot('permission_id', 'role_id');
    }

    /**
     * Determine if the permission belongs to the role.
     *
     * @param  mixed $role
     * @return boolean
     */
    public function inRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }
        return !! $role->intersect($this->roles)->count();
    }
}
