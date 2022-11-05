<?php

namespace App\Http\Controllers\User\Meet\Horario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\Meet\HorarioRequest;
use App\Models\{Meet, Participant, Topic, Horario};
use Exception;
use Illuminate\Support\Facades\DB;

class HorarioController extends Controller
{
    public function index($id)
    {
        $meet = Meet::find($id);
        $meets = Meet::all();

        $participants = Participant::where('meet_id', $meet->id)->get();
        $horarios = Horario::where('meet_id', $meet->id)->get();
        $topics = Topic::where('meet_id', $meet->id)->get();

        $tamanho = count($horarios);

        return view('user.meets.meet', compact('meet', 'meets', 'horarios', 'tamanho', 'topics', 'participants'));
    }

    // public function create($id)
    // {
    //     $meet = Meet::find($id);
    //     $meets = Meet::all();

    //     return view('user.meets.create_horario', compact('meet', 'meets'));
    // }

    public function store(HorarioRequest $request, $id)
    {
        try {
            $meet = Meet::find($id);
            $request->request->add(['meet_id' => $meet->id]);
            // $req = $request->add(['meet_id' => $meet->id]);
            $requestData = $request->all();
            $horario = Horario::create($requestData);

            return redirect()
                ->route('horarios.index', compact('id'));
        } catch (Exception $exception) {
            DB::rollBack();
            return 'Mensagem: ' . $exception->getMessage();
        }
    }

    public function update(Request $request, Meet $meet , Horario $horario)
    {
        $request['votes'] = $horario->votes + $request['votes'];
        $horario->update(['votes' => $request['votes']]);
        return redirect()
            ->route('horarios.index', $meet->id)
            ->with('success', 'Votos Registrados!');
    }
}
