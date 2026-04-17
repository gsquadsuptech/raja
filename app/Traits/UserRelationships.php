<?php

namespace App\Traits;

use App\User;
use Illuminate\Support\Facades\Auth;

trait UserRelationships
{

    public function cree_par() {
        return $this->belongsTo(User::class, 'user_created');
    }

    public function modifie_par() {
        return $this->belongsTo(User::class, 'user_modified');
    }

    public static function boot()
    {
        parent::boot();

        static::creating( function ($model)
        {
            $model->user_created = Auth::user()->id ?? '';
            $model->user_modified = Auth::user()->id ?? '';
        });

        static::updating( function ($model)
        {
            $model->user_modified = Auth::user()->id ?? '';
        });
    }
}