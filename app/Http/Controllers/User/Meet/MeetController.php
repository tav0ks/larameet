<?php

namespace App\Http\Controllers\User\Meet;

use App\Models\{
    Meet,
    Horario
};
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Meet\{
    MeetRequest,
    HorarioRequest
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Auth;

class MeetController extends Controller
{
    public function meet($id)
    {
        $url_id = Meet::where('id', $id)->get();

        $meets = Meet::all();

        $horarios = Horario::all()->where('meet_id', $url_id[0]->id);

        return view('user.meets.meet', compact('url_id', 'meets', 'horarios'));
    }

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

    public function create_horario()
    {
        return view('user.meets.create_horario', [
            'meets' => Meet::all()
        ]);
    }

    public function store_horario(HorarioRequest $request, $id)
    {
        $requestData = $request->validated();

        $horario = Horario::create($requestData);
        
        $horario['meet_id'] = $id;

        


    }
}
