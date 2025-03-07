<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(){
        $user = Auth::check() ? Auth::user() : false;

        return view('post', compact('user'));
    }
}
