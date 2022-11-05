<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
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

        if (Auth::attempt($credentials)) {
            return redirect()->route('user.meets.index');
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
        $user = User::where('uuid', $request->uuid)->first();

        $credentials = [
            'email' => $user->email,
            'password' => $user->uuid,
        ];

        // dd(Auth::attempt($credentials));
        if (Auth::attempt($credentials)) {
            
            if ($user->name == null || $user->name == "") {
                
                return redirect()->route('participant.edit', $user->uuid);
            }

            return redirect()
                ->route('horario.meet', $user->meet_id);
        }

        return redirect()
            ->route('auth.login.create')
            ->with('warning', 'Autenticação falhou')
            ->withInput();
    }
}
