<?php

namespace App\Http\Controllers\User\Meet;

use App\Models\{
    Meet,
    Horario,
    Participant,
    Topic
};
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Meet\{
    MeetRequest,
    HorarioRequest
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

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

        $requestData = $request->validated();

        $requestData['meet']['user_id'] = Auth::id();


        DB::beginTransaction();
        try {

            $meet = Meet::create($requestData['meet']);

            $meet->horario()->create($requestData['horario']);

            DB::commit();

            return redirect()
                ->route('user.meets.index')
                ->with('success', 'Meet cadastrado');
        } catch (Exception $exception) {
            DB::rollBack();
            return 'Mensagem: ' . $exception->getMessage();
        }
    }
}
