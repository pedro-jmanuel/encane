<?php

namespace App\Http\Controllers\Administracao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function create(Request $request){

        if (Auth::check()) {
                return redirect("/home");
        }else{
            return view('administracao.pages.login');
        }
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email','password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect("/home");

        }else{
            return redirect()->back()->with("erro", "Acesso negado . ");
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
