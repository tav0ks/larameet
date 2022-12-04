<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'horario_id',
        'meet_id',
        'value'
    ];

    //relationships
    public function horario()
    {
        return $this->belongsTo(Horario::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function meet()
    {
        return $this->belongsTo(Meet::class);
    }

}
