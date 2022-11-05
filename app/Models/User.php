<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_participant',
        'meet_id',
        'uuid'
    ];

    protected $hidden = [
        'password',
    ];

    //relationships
    public function meet()
    {
        return $this->HasMany(Meet::class);
    }

    //mutators
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    protected static function boot(){
        parent::boot();

        static::creating(function($model){
            if(empty($model->uuid) && $model->is_participant == 1){
                $uuid = Str::uuid();
                $model->uuid= $uuid;
                $model->password=  $uuid;
            }
        });
    }
}
