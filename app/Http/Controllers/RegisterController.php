<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index(){
        Auth::logout();

        if(Auth::check()) return redirect()->route('home');

        return view('auth.register');
    }

    public function register(Request $request){
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        // Create a user
        $user = new User();

        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();


        // Create a profile for the user
        $profile = new Profile();

        $profile->user_id = $user->id;
        $profile->save();


        // Log the user in
        Auth::login($user);

        return redirect()->route('home');
    }
}
