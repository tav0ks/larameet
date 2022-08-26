<?php

namespace App\Http\Controllers\User\Meet;

use App\Models\Meet;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Meet\MeetRequest;

class MeetController extends Controller
{
    public function index()
    {
        return view('user.meets.index', [
            'meets' => Meet::all()
        ]);
    }

    public function create()
    {
        return view('user.meets.create', [
            'meets' => Meet::all()
        ]);
    }

    public function store(MeetRequest $request)
    {

        Meet::create($request->validated());

        return redirect()
            ->route('user.meets.index')
            ->with('success', 'Meet cadastrado');
    }
}
