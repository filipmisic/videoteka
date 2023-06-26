<?php

namespace App\Http\Controllers\termilan;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoyaltyCreate;
use App\Models\User;



class LoyaltyController extends Controller
{
    public function index()
    {
        return view('pages.terminal.loyalty');
    }
    public function create(LoyaltyCreate $request)
    {
        User::create([
            'name' => $request->name,
            'email' => Null,
            'password' => Null,
            'oib' => $request->oib,
        ]);
        return redirect('/terminal/dashboard');
    }
}
