<?php

namespace App\Http\Controllers\User\Meet\Horario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\Meet\HorarioRequest;
use App\Models\{Meet, User, Topic, Horario};
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HorarioController extends Controller
{
    public function index($id)
    {
        $meet = Meet::find($id);
        $meets = Meet::all();

        $user = User::find(Auth::id());
        $horarios = Horario::where('meet_id', $meet->id)->get();


        return view('user.meets.meet', compact('user','meet', 'meets', 'horarios',));
    }

    public function store(HorarioRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $meet = Meet::find($id);
            $request->request->add(['meet_id' => $meet->id]);
            $requestData = $request->all();
            $horario = Horario::create($requestData);

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
}
