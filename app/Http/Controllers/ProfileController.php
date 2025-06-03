<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($name){
        $user = User::where('name', $name)->first();
        if(!$user) return redirect()->route('home');
        if($user->profile->trashed()) return redirect()->route('home');

        return view('profile', compact('profile'));
    }
}
