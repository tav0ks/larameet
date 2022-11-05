<?php

namespace App\Http\Controllers\User\Meet\Participant;

use App\Http\Controllers\Controller;
use App\Models\Meet;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

            // Mail::send(new ConfirmacaoParticipant($participant));
            DB::commit();
            
            return redirect()
                ->route('horario.meet', compact('id'));
                
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
            $participant = User::where('uuid',$uuid)->first();
            $participant->update([
                'name' => $request->name
            ]);

            DB::commit();
            return redirect()
                ->route('horario.meet', $participant->meet_id);
        } catch (Exception $exception) {
            DB::rollBack();
            return 'Mensagem: ' . $exception->getMessage();
        }
    }
}
