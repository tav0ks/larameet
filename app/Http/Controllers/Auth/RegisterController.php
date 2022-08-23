<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $requestData = $request->validated();

        DB::beginTransaction();

        try {

            User::create($requestData);
            DB::commit();

            return redirect()
                ->route('auth.login.create')
                ->with('success', 'Conta criada com sucesso! Efetue o Login');
        } catch (\Exception $exeception) {
            DB::rollback();
            return 'Mensagem:' . $exeception->getMessage();
        }
    }
}
