<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
<<<<<<< HEAD
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
=======
use Illuminate\Database\Eloquent\Model;

class User extends Model
>>>>>>> a875b7d438a38c2e34c4db4d1c2a95929cdcf116
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    //mutators
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
