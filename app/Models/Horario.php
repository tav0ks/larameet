<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Horario extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'meet_date',
        'meet_start',
        'votes',
        'day',
        'month',
        'meet_id'
    ];

    //relationships
    public function meet()
    {
        return $this->belongsTo(Meet::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    //mutators
    public function setMeetDateAttribute($value)
    {
        $this->attributes['meet_date'] = Carbon::createFromFormat('d/m/Y', $value)
            ->format('Y-m-d H:i:s');
    }
    public function setMeetStartAttribute($value)
    {
        $this->attributes['meet_start'] = Carbon::createFromFormat('H:i', $value)
            ->format('Y-m-d H:i:s');
    }

    //accessors
    public function getMeetDateFormattedAttribute()
    {
        return Carbon::parse($this->meet_date)->format('d/m/Y');
    }

    public function getMeetStartFormattedAttribute()
    {
        return Carbon::parse($this->meet_start)->format('H:i');
    }

}
