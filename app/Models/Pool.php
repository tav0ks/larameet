<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pool extends Model
{
    use HasFactory;

    protected $table = 'pools';

    protected $fillable = [
        'name'
    ];

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function dates(){
        return $this->hasMany(Date::class);
    }

    public function participants()
    {
        return $this->belongsToMany(Participant::class);
    }
    
}
