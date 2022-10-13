<?php

namespace App\Http\Controllers\User\Meet\Topic;

use App\Http\Controllers\Controller;
use App\Models\{Meet, Topic};
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TopicController extends Controller
{
    public function store(Request $request, $id){
        try {
            $meet = Meet::find($id);
            $request->request->add(['meet_id' => $meet->id]);
            $requestData = $request->all();

            $topic = Topic::create($requestData);

            return redirect()
                ->route('horario.meet', $id);
        } catch (Exception $exception) {
            // DB::rollBack();
            return 'Mensagem: ' . $exception->getMessage();
        }
    }
}
