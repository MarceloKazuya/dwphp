<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {

    public function login(Request $request){
        $credentials = $request->only(['nome','password']);
        if(!Auth::attempt($credentials)) {
            return redirect()
                ->back()
                ->withErrors('Usuário e/ou senha incorretos');
        }
        return redirect()->route('main');
    }

    public function index( Request $request ) {
        return view('auth.login');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('home');
    }
}
