<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    protected $table = 'datas';

    protected $fillable = [
        'start_date',
        'start_date_hour',
        'end_date',
        'end_date_hour',
        'pool_id'
    ];

    public function pools()
    {
        return $this->belongsTo(Pool::class);
    }
}
