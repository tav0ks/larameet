<?php

namespace App\Http\Controllers\Pool;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PoolController extends Controller
{

    public function index()
    {
        return view('pool.index');
    }

    public function store(Request $request)
    {
        //$requestData = $request
    }

}
