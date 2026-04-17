<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    
    protected $fillable = [
        'name',
    ];

    public function permissions() {
        return $this->belongsToMany(Permission::class, 'roles_permissions');
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

    public static function boot()
    {
        parent::boot();

        static::deleting(function($model)
        {
            $model->permissions()->detach();
        });
    }
}
