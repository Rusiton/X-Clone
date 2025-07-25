<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index(){
        if(Auth::user()) return redirect()->route('home');
        
        return view('auth.register');
    }
}
