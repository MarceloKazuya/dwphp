<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller {

    public function create(Request $request) {
        return view('auth.register');
    }

    public function store(Request $request) {
        $data = $request->except('_token');
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        Auth::login($user);
        return redirect()->route('main');
    }
}
