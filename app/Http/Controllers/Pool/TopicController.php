<?php

namespace App\Http\Controllers\Pool;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function store(Request $request)
    {
        $requestData = $request->all();

        $topic = Topic::create($requestData);
    }
}
