<?php

namespace App\Http\Controllers\User\Meet\Topic;

use App\Http\Controllers\Controller;
use App\Models\{Meet, Topic, User};
use Exception;
use Illuminate\Http\Request;
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

    public function edit($id)
    {
        $meet = Meet::find($id);
        $meets = Meet::all();
        $participants = User::where('meet_id', $meet->id)->where('name', '!=', '')->get();
        $pauta = Topic::where('meet_id', $id)->first();

        return view('user.meets.pauta', compact('id', 'meet', 'meets', 'participants', 'pauta'));
    }

    public function print($id)
    {
        $pauta = Topic::where('meet_id', $id)->first();
        return view('user.print.print', compact('pauta')); //TODO arrumar print
    }
}
