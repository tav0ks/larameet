<?php

namespace App\Http\Controllers\User\Meet\Horario\Vote;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vote;
use Illuminate\Support\Facades\DB;
use Exception;

class VoteController extends Controller
{
    public function update(Request $request, Vote $vote)
    {

        // dd($request['meet_id']);
        if($request['value']=='1'){
            $vote->update(['value' =>'0']);
            return redirect()
                ->route('horarios.index', $request['meet_id'])
                ->with('success', 'Voto Atualizado!');
        }
        if($request['value']=='0'){
            $vote->update(['value' =>'1']);
            return redirect()
                ->route('horarios.index', $request['meet_id'])
                ->with('success', 'Voto Atualizado!');
        }
    }
}
