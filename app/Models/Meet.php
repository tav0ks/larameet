<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Meet extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'agenda',
        'user_id'
    ];

    //relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function horario()
    {
        return $this->hasMany(Horario::class);
    }
}
