<?php

namespace App\Http\Controllers\User\Meet\Participant;

use App\Http\Controllers\Controller;
use App\Models\Meet;
use App\Models\Participant;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParticipantController extends Controller
{

    public function store(Request $request, $id)
    {
        try {
            $meet = Meet::find($id);
            $request->request->add(['meet_id' => $meet->id]);
            $requestData = $request->all();

            $participant = Participant::create($requestData);

            return redirect()
                ->route('horario.meet', compact('id'));
                
        } catch (Exception $exception) {
            // DB::rollBack();
            return 'Mensagem: ' . $exception->getMessage();
        }
    }
}
