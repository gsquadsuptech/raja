<?php

namespace App\Models;

use App\Traits\UserRelationships;
use App\User;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Roles extends Model
{
    use UserRelationships;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function users() {
        return $this->hasMany(User::class)->orderBy('order', 'DESC');
    }

    public function permissions() {
        return $this->belongsToMany(Permission::class, 'roles_permissions', 'permission_id', 'role_id')->withPivot('permission_id', 'role_id');
    }

    public function givePermissionTo(Permission $permission)
    {
        return $this->permissions()->save($permission);
    }
    /**
     * Determine if the user may perform the given permission.
     *
     * @param  Permission $permission
     * @return boolean
     */
    public function hasPermission(Permission $permission, User $user)
    {
        return $this->hasRole($permission->roles);
    }
    /**
     * Determine if the role has the given permission.
     *
     * @param  mixed $permission
     * @return boolean
     */
    public function inRole($permission)
    {
        if (is_string($permission)) {
            return $this->permissions->contains('slug', $permission);
        }
        return !! $permission->intersect($this->permissions)->count();
    }

}
