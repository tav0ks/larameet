<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UuidLoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::guard('participant')->attempt($credentials)) {
            return redirect()->route('participant.meets.index');
        }

        return redirect()
            ->route('auth.login.create')
            ->with('warning', 'Autenticação falhou')
            ->withInput();
    }

    public function destroy()
    {
        Auth::logout();
        return redirect()->route('auth.login.create');
    }

    public function uuidStore(Request $request)
    {
        // dd($request);
        $participant = Participant::where('uuid', $request->uuid)->first();

        $credentials = [
            'email' => $participant->email,
            'password' => $participant->uuid,
        ];

        // dd(Auth::attempt($credentials));
        if (Auth::attempt($credentials)) {

            if ($participant->name == null || $participant->name == "") {

                return redirect()->route('participant.edit', $participant->uuid);
            }

            return redirect()
                ->route('horarios.index', $participant->meet_id);
        }

        return redirect()
            ->route('auth.login.create')
            ->with('warning', 'Autenticação falhou')
            ->withInput();
    }
}
