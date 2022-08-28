<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Meet;

class IndexController extends Controller
{
    public function index()
    {
        return view('user.meets.index', [
            'meets' => Meet::all()
        ]);
    }
}
