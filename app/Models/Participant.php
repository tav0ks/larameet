<?php

namespace App\Models;

use App\Models\Traits\hasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'meet_id'
    ];

    public function meet()
    {
        return $this->belongsTo(Meet::class);
    }

}
