<?php
namespace App\Permissions;

use App\Models\Permission;
use App\Models\Roles;

trait HasPermissionsTrait {

    public function role() {
        return $this->belongsTo(Roles::class);
    }

    public function permissions() {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }

    public function hasRole( ... $roles ) {
	    foreach ($roles as $role) {
			if ($this->roles->contains('slug', $role)) {
				return true;
			}
		}
		return false;
	}
     
    protected function hasPermission($permission) {
        return (bool) $this->permissions->where('slug', $permission->slug)->count();
    }

    public function hasPermissionThroughRole($permission) {
        foreach ($permission->roles as $role){
            if($this->role === $role) {
                return true;
            }
        }
        return false;
    }

    public function hasPermissionTo($permission) {
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
    }

    public function givePermissionsTo(... $permissions) {
        $permissions = $this->getAllPermissions($permissions);
        dd($permissions);
        if($permissions === null) {
           return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }

    public function deletePermissions( ... $permissions ) {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }

    protected function getAllPermissions(array $permissions) {
		return Permission::whereIn('slug', $permissions)->get();
	}
}