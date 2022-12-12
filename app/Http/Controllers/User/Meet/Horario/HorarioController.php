<?php

namespace App\Http\Controllers\User\Meet\Horario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\Meet\HorarioRequest;
use App\Models\{Meet, Topic, Horario, User, Vote};
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HorarioController extends Controller
{
    public function index($id)
    {
        $meet = Meet::find($id);
        $meets = Meet::all();

        $participants = User::where('meet_id', $meet->id)->get();
        $user = User::find(Auth::id());
        $horarios = Horario::where('meet_id', $meet->id)->get();


        if($user->is_participant != 0){
            $votes = Vote::where('user_id', $user->id)->get();
        } else {
            $votes = Vote::where('user_id', $user->id)->where('meet_id', $meet->id)->get();
        }

        foreach ( $horarios as $horario ){
            $votes_to_count = Vote::where('horario_id', $horario->id)->get();
            $value = 0;
            foreach ( $votes_to_count as $vote ){
                $value = $value + intval($vote->value);
            }
            $horario->update([
                'votes' => $value
            ]);
        }


        if($horarios->count() > 0){
            $most_voted = $horarios->sortByDesc('votes')->first();
            if($horarios->count() > 1){
                $runner_up = $horarios->sortByDesc('votes')->skip(1)->first();

                if($most_voted->votes == $runner_up->votes) {

                    $most_voted_list = Horario::where('votes', $most_voted->votes)->where('meet_id', $meet->id)->pluck('id');

                    // dd($most_voted_list);

                    return view('user.meets.meet', compact('user','meet', 'meets', 'horarios', 'participants', 'votes', 'most_voted_list'));
                }
            }

            return view('user.meets.meet', compact('user','meet', 'meets', 'horarios', 'participants', 'votes', 'most_voted'));
        }

        return view('user.meets.meet', compact('user','meet', 'meets', 'horarios', 'participants', 'votes'));
    }

    public function store(HorarioRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $meet = Meet::find($id);
            $request->request->add(['meet_id' => $meet->id]);
            $requestData = $request->all();
            $horario = Horario::create($requestData);
            $participants = User::where('meet_id', $meet->id)->where('name','!=','')->get();

            $vote = Vote::create([
                'user_id' =>  Auth::user()->id,
                'horario_id' => $horario->id,
                'meet_id' => $meet->id
            ]);

            foreach ($participants as $participant) {
                $vote = Vote::create([
                    'user_id' => $participant->id,
                    'horario_id' => $horario->id,
                    'meet_id' => $meet->id
                ]);
            }

            $date = explode(' ',$horario->meet_date);
            $day = jddayofweek((date('w', strtotime($date[0])) - 1), 1);

            if($day == 'Sunday'){
                $day = 'Dom';
            }
            if($day == 'Monday'){
                $day = 'Seg';
            }
            if($day == 'Tuesday'){
                $day = 'Ter';
            }
            if($day == 'Wednesday'){
                $day = 'Qua';
            }
            if($day == 'Thursday'){
                $day = 'Qui';
            }
            if($day == 'Friday'){
                $day = 'Sex';
            }
            if($day == 'Saturday'){
                $day = 'Sab';
            }

            $month = explode('/',$requestData['meet_date'])[1];

            if($month == '01'){
                $month = 'Jan';
            }
            if($month == '02'){
                $month = 'Fev';
            }
            if($month == '03'){
                $month = 'Mar';
            }
            if($month == '04'){
                $month = 'Abr';
            }
            if($month == '05'){
                $month = 'Mai';
            }
            if($month == '06'){
                $month = 'Jun';
            }
            if($month == '07'){
                $month = 'Jul';
            }
            if($month == '08'){
                $month = 'Ago';
            }
            if($month == '09'){
                $month = 'Set';
            }
            if($month == '10'){
                $month = 'Oct';
            }
            if($month == '11'){
                $month = 'Nov';
            }
            if($month == '12'){
                $month = 'Dez';
            }

            $horario->update(['day' => $day, 'month' => $month]);

            DB::commit();

            return redirect()
                ->route('horarios.index', compact('id'));
        } catch (Exception $exception) {
            DB::rollBack();
            return 'Mensagem: ' . $exception->getMessage();
        }
    }

    public function edit(Horario $horario)
    {
        return view('user.meets.horarios.edit', compact('horario'));
    }

    public function update(HorarioRequest $request, Horario $horario)
    {

        $requestData = $request->validated();
        DB::beginTransaction();
        try {
            $meet = Meet::where('id', $horario->meet_id)->first();
            $horario->update($requestData);
            DB::commit();
            return redirect()
                ->route('horarios.index', $meet->id)
                ->with('success', 'Horario Atualizado!');
        } catch (Exception $exception) {
            DB::rollBack();
            return 'Mensagem: ' . $exception->getMessage();
        }
    }

    public function destroy(Horario $horario)
    {
        try {

            $meet = $horario->meet();
            $meets = Meet::all();
            $horario->delete();
            $user = User::find(Auth::id());

            return redirect()
                ->route('user.meets.meet', compact('user', 'meet', 'meets', 'horarios'))
                ->with('success', 'Meet '. $horario->name .' deletado com sucesso!');
        } catch (\Exception $exception) {
            DB::rollBack();
            return 'Mensagem: ' . $exception->getMessage();
        }
    }

    public function getBasicData(Horario $horario)
    {
        return [
            'id' => $horario->id,
            'meet_date' => $horario->meet_date_formatted,
            'meet_start' => $horario->meet_start_formatted
        ];
    }
}
