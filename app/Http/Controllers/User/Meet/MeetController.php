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
    public function index_horarios($id)
    {
        $meet = Meet::find($id);

        $meets = Meet::all();

        $horarios = Horario::where('meet_id', $meet->id)->get();

        return view('user.meets.meet', compact('meet', 'meets', 'horarios'));
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

    public function create_horario($id)
    {
        $meet = Meet::find($id);
        $meets = Meet::all();

        return view('user.meets.create_horario', compact('meet','meets'));
    }

    public function store_horario(HorarioRequest $request, $id)
    {
        $meet = Meet::find($id);
        $request->request->add(['meet_id' => $meet->id]);
        // $req = $request->add(['meet_id' => $meet->id]);
        $requestData = $request->all();
        $horario = Horario::create($requestData);

        return redirect()
                ->route('user.meets.meet', compact ('id'));

    }
}
