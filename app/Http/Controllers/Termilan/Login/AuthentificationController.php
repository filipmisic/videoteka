<?php

namespace App\Http\Controllers\Termilan\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkerLogin;
use App\Models\Rent;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthentificationController extends Controller
{
    public function login()
    {
        if(Auth::guard('worker')->user()) return redirect('/terminal/dashboard');
        return view('pages.terminal.login.login');

    }
    public function authentification(WorkerLogin $request)
    {
       if(Auth::guard('worker'))redirect('/terminal/dashboard');
       if(! auth()->guard('worker')->attempt([
            'number' => $request->number,
            'password' => $request->password,
       ])) return redirect('/terminal');

       $request->session()->regenerate();
       return redirect('/terminal/dashboard');

    }
    public function logout(Request $request)
    {
        Auth::guard('worker')->logout(); 
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/terminal');
    }
    public function index()
    {
        return view('pages.terminal.dashboard');
    }
}
