<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register');
    }
}
