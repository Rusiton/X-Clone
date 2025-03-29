<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveUserSettingsRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public $user;

    public function __construct() {
        $this->user = Auth::user();
    }



    public function index(){
        $user = $this->user;
        if(!$user) return redirect()->route('login');

        return view('settings', compact('user'));
    }



    public function update(SaveUserSettingsRequest $request){
        $user = User::find($this->user->id);

        $user->update($request->validated());
        $user->profile->update($request->validated());
        $user->settings->update($request->validated());
        
        return redirect()->route('profile', ['name' => $user->name]);
    }
}
