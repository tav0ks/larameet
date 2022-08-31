<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model{
    use HasFactory;

    protected $table = ['participants'];

    protected $fillable = [
        'name',
        'pool_id'
    ];

    public function pools(){
        return $this->belongsToMany(Pool::class);
    }
}