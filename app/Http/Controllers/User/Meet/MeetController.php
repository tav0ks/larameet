<?php

namespace App\Http\Controllers\User\Meet;

use App\Models\{
    Meet,
    Horario,
    Participant,
    Topic,
    User
};
use App\Http\Controllers\Controller;

use App\Http\Requests\User\Meet\{
    MeetRequest,
    HorarioRequest
};
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Auth;

class MeetController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());

        $meets = Meet::query()->where('user_id', $user->id);

        $meets = $meets->get();

        return view('user.meets.index', compact('user', 'meets'));
    }

    public function create()
    {
        return view('user.meets.create');
    }

    public function store(MeetRequest $request)
    {
        $requestData = $request->validated();

        $requestData['user_id'] = Auth::id();

        DB::beginTransaction();
        try {
            $meet = Meet::create($requestData);
            Topic::create([
                'pauta' => '', //TODO terminar a entrada padrão da 'folha'
                'meet_id' => $meet->id,
            ]);

            DB::commit();

            return redirect()
                ->route('horarios.index', $meet->id)
                ->with('success', 'Meet '. $meet->name .' cadastrado, agora cadastre um horário para o Meet ocorrer!');
        } catch (Exception $exception) {
            DB::rollBack();
            return 'Mensagem: ' . $exception->getMessage();
        }
    }

    public function edit(Meet $meet)
    {
        return view('user.meets.edit', compact('meet'));
    }

    public function update(MeetRequest $request, Meet $meet)
    {

        $requestData = $request->validated();

        DB::beginTransaction();
        try {
            $meet->update($requestData);
            // $participants = User::where
            DB::commit();

            $user = User::find(Auth::id());
            $meets = Meet::query()->where('user_id', $user->id);
            $meets = $meets->get();

            return redirect()
                ->route('user.meets.index', compact('user', 'meets'))
                ->with('success', 'Meet atualizado com sucesso!');

        } catch (Exception $exception) {
            DB::rollBack();
            return 'Mensagem: ' . $exception->getMessage();
        }
    }

    public function destroy(Meet $meet)
    {
        try {
            $meet->horarios()->delete();
            $meet->delete();

            $user = User::find(Auth::id());
            $meets = Meet::query()->where('user_id', $user->id)->get();

            return redirect()
                ->route('user.meets.index', compact('user', 'meets'))
                ->with('success', 'Meet '. $meet->name .' deletado com sucesso!');
        } catch (\Exception $exception) {
            DB::rollBack();
            return 'Mensagem: ' . $exception->getMessage();
        }
    }

    public function getBasicData(Meet $meet)
    {
        return [
            'id' => $meet->id,
            'name' => $meet->name
        ];
    }

}
