<?php

namespace App\Http\Controllers\User\Meet\Participant;

use App\Mail\ConfimacaoParticipant;
use App\Http\Controllers\Controller;
use App\Models\{Meet, User, Vote};
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmacaoParticipant;
use App\Mail\ReenvioToken;
use Hamcrest\Type\IsObject;
use stdClass;

class ParticipantController extends Controller
{

    public function store(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $meet = Meet::find($id);
            $request->request->add(['meet_id' => $meet->id]);
            $requestData = $request->all();

            $participant = User::create([
                'name' => '',
                'email' => $request->email,
                'meet_id' => $request->meet_id,
                'is_participant' => $request->is_participant
            ]);

            $horarios = $meet->horarios;

            foreach ($horarios as $horario) {
                $vote = Vote::create([
                    'user_id' => $participant->id,
                    'horario_id' => $horario->id,
                    'meet_id' => $meet->id
                ]);
            }

            Mail::send(new ConfirmacaoParticipant($participant)); //TODO não esquecer de ativar ou desativar quando necessário
            DB::commit();

            return redirect()
                ->route('horarios.index', compact('id'));
        } catch (Exception $exception) {
            DB::rollBack();
            return 'Mensagem: ' . $exception->getMessage();
        }
    }

    public function edit($uuid)
    {
        return view('user.meets.home_participant', compact('uuid'));
    }

    public function update(Request $request, $uuid)
    {
        DB::beginTransaction();
        try {
            $participant = User::where('uuid', $uuid)->first();
            $participant->update([
                'name' => $request->name
            ]);

            DB::commit();
            return redirect()
                ->route('horarios.index', $participant->meet_id);
        } catch (Exception $exception) {
            DB::rollBack();
            return 'Mensagem: ' . $exception->getMessage();
        }
    }

    public function mail(Request $request, $id)
    {

        foreach ($request->key as $uuid) {
            $participant = User::where('uuid', $uuid)->first();
            Mail::send(new ReenvioToken($participant));
            return redirect()
                ->route('horarios.index', compact('id'));
        }
    }
}
