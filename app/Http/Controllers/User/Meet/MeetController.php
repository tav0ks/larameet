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
use App\Mail\MeetEncerrado;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MeetController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());

        $meets = Meet::query()->where('user_id', $user->id);
        $meets_participant = Meet::where('id', $user->meet_id)->get();
        $meets = $meets->get();

        return view('user.meets.index', compact('user', 'meets', 'meets_participant'));
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
                ->with('success', 'Meet ' . $meet->name . ' cadastrado, agora cadastre um horário para o Meet ocorrer!');
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
            $participants = User::where('is_participant', 1)->where('meet_id', $meet->id)->delete();
            $user = User::find(Auth::id());
            $meets = Meet::query()->where('user_id', $user->id)->get();

            return redirect()
                ->route('user.meets.index', compact('user', 'meets'))
                ->with('success', 'Meet ' . $meet->name . ' deletado com sucesso!');
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

    public function mail($id, $most_voted) //TODO
    {
        $users = User::where('meet_id', $id)->get();

        $most_voted = Horario::find($most_voted);
        $pauta = Topic::where('meet_id', $id)->first();
        $meet = Meet::find($id);
        $user = User::find($meet->user_id);
        $participants = User::where('meet_id', $id)->get();
        $dompdf = new Dompdf();
        $pdf = $dompdf->loadHtml(view(('user.print.renderPrint'), compact('pauta', 'meet', 'participants', 'user', 'most_voted')));
        $dompdf->setPaper('A4', 'portrait');


        return redirect()
            ->route('horarios.index', $meet->id);
    }
}
