<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function getUserRegistrationStage(){
        $user = Auth::user();

        if(!$user) return 0;
        if(!$user->name) return 1;
    }



    public function index(){
        $registration_stage = $this->getUserRegistrationStage();
        return view('auth.register', compact('registration_stage'));
    }



    public function validateStage(Request $request){
        $registration_stage = $this->getUserRegistrationStage();

        if($registration_stage == 0){
            return $request->validate([
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8',
            ]);
        }

        if($registration_stage == 1){
            return $request->validate([
                'profile_picture' => 'image|max:2048',
                'username' => 'required|min:3|max:20|unique:users',
                'name' => 'required|min:3|max:30'
            ]);
        }
    }



    public function registerByStage(Request $request){
        $registration_stage = $this->getUserRegistrationStage();

        if($registration_stage == 0){
            // Creates a user
            $user = new User();

            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();


            // Creates a profile for the user
            $profile = new Profile();

            $profile->user_id = $user->id;
            $profile->save();


            // Logs the user in
            Auth::login($user);
        }
    }



    public function register(Request $request){
        $this->registerByStage($request);
    }
}
