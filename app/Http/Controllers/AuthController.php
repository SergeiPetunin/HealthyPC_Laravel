<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;//модель
use Auth;//сервис для аутентификации

class AuthController extends Controller
{
    // заполнение формы Login
    public function login()
    {
        return view('login');
    }

   // обработка формы Login
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) { //если аутентификация прошла успешно
            // return redirect('/dashboard');
            return redirect('/');
        }
        return redirect('login')->with('error', 'Oops! You entered incorrect credentials!');
    }
    
    //выход пользователя из аутентификации
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function register()
    {
        return view('/');
    }
}
