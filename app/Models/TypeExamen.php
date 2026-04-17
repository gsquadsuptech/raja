<?php

namespace App\Models;

use App\Traits\UserRelationships;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TypeExamen extends Model
{
    use UserRelationships;

    protected $fillable = [
        'type_examen_nom'
    ];

//    public static function boot()
//    {
//        parent::boot();
//
//        static::creating( function ($model)
//        {
//            $model->user_created = Auth::user()->id;
//            $model->user_modified = Auth::user()->id;
//        });
//
//        static::updating( function ($model)
//        {
//            $model->user_modified = Auth::user()->id;
//        });
//    }
}
