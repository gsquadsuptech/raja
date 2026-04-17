<?php

namespace App\Policies;

use App\User;
use App\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  $perm
     * @return mixed
     */
    public function permission(User $user, $perm)
    {
        $permission = Permission::where('slug', $perm)->first();
        return $permission->inRole($user->role->name);
    }
}
