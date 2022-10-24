<?php

namespace App\Http\Controllers\User\Meet\Participant;

use App\Http\Controllers\Controller;
use App\Mail\ConfimacaoParticipant as ConfirmacaoParticipant;
use App\Models\Meet;
use App\Models\Participant;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ParticipantController extends Controller
{

    public function store(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $meet = Meet::find($id);
            $request->request->add(['meet_id' => $meet->id]);
            $requestData = $request->all();
            
            $participant = Participant::create([
                'name' => '',
                'email' => $request->email,
                'meet_id' => $meet->id
            ]);

            Mail::send(new ConfirmacaoParticipant($participant));
            DB::commit();
            
            return redirect()
                ->route('horario.meet', compact('id'));
                
        } catch (Exception $exception) {
            DB::rollBack();
            return 'Mensagem: ' . $exception->getMessage();
        }
    }

    public function update(Request $request, $id, $uuid)
    {
        DB::beginTransaction();
        try {
            $meet = Meet::find($id);

            $participant = Participant::find($uuid);
            $participant->update([
                'name' => $request->name
            ]);
            return redirect()
                ->route('horario.meet', compact('id'));
        } catch (Exception $exception) {
            DB::rollBack();
            return 'Mensagem: ' . $exception->getMessage();
        }
    }
}
