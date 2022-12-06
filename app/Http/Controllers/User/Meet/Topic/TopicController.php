<?php

namespace App\Http\Controllers\User\Meet\Topic;

use App\Http\Controllers\Controller;
use App\Models\{Meet, Participant, Topic, User, Vote};
use Dompdf\Dompdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TopicController extends Controller
{
    public function update(Request $request, $id)
    {
        try {

            $pauta = Topic::where('meet_id', $id); //TODO transform to update
            $pauta->update([
                'pauta' => $request->pauta
            ]);

            return redirect()
                ->route('horarios.index', $id);
        } catch (Exception $exception) {
            // DB::rollBack();
            return 'Mensagem: ' . $exception->getMessage();
        }
    }

    public function edit($id, $most_voted)
    {
        $meet = Meet::find($id);
        $meets = Meet::all();
        $participants = User::where('meet_id', $meet->id)->where('name', '!=', '')->get();
        $pauta = Topic::where('meet_id', $id)->first();
        $most_voted = Vote::find($most_voted);

        return view('user.meets.pauta', compact('id', 'meet', 'meets', 'participants', 'pauta', 'most_voted'));
    }

    public function print($id, $most_voted)
    {
        $pauta = Topic::where('meet_id', $id)->first();
        $meet = Meet::find($id);
        $user = User::find($meet->user_id);
        // if(Auth::guard() == 'web'){
        //     $user = User::find($meet->user_id);
        // }
        // else $user = Participant::where('meet_id',$meet->id)->get();

        $participants = User::where('meet_id', $id);
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view(('user.print.renderPrint'),compact('pauta','meet','participants', 'user' ,'most_voted')));
        $dompdf->setPaper('A4','portrait');
        $dompdf->render();
        $dompdf->stream();
        return view('user.print.print', compact('pauta')); //TODO arrumar print
    }
}
