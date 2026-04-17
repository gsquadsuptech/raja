<?php

namespace App;

use App\Permissions\HasPermissionsTrait;
use App\Models\Roles;
use App\Traits\UserRelationships;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'prenoms', 'nom', 'role_id', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
 

    /*
	|--------------------------------------------------------------------------
	| RELATIONS
	|--------------------------------------------------------------------------
    */
    public function role()
    {
        return $this->belongsTo(Roles::class);
    }

    public function assignRole(Role $role)
    {
        return $this->role()->save($role);
    }

    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }
        return !! $role->intersect($this->roles)->count();
    }

    public function getRoleNomAttribute() {
        return $this->role->name ?? '';
    }

    public function getActivedAttribute() {
        if($this->is_active)
            return '<i class="material-icons md-color-light-blue-600 md-24">&#xE86C;</i>';
        else
            return '<i class="material-icons md-color-red-600 md-24">&#xE86C;</i>';
        
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
//    public function scopeActive($query) {
//        $query->where('is_active', 1);
//    }
   
}
