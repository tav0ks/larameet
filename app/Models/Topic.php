<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'pauta',
        'meet_id'
    ];

    public function meet()
    {
        return $this->belongsTo(Meet::class);
    }
}
