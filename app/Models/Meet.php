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
        'duration',
        'user_id'
    ];

    //relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    //accessors
    public function getDurationFormattedAttribute()
    {
        return Carbon::parse($this->duration)->format('H:i');
    }

    //mutators
    public function setDurationAttribute($value)
    {
        $this->attributes['duration'] = Carbon::createFromFormat('H:i', $value)
            ->format('Y-m-d H:i:s');
    }

}
