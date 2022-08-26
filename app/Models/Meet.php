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
        'meet_date',
        'agenda'
    ];

    //relationships

    public function user()
    {
        return $this->BelongsTo(User::class);
    }

    //mutators
    public function setMeetDateAttribute($value)
    {
        $this->attributes['meet_date'] = Carbon::createFromFormat('d/m/Y', $value)
            ->format('Y-m-d H:i:s');
    }
}
