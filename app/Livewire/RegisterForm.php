<?php

namespace App\Livewire;

use App\Models\Profile;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;

class RegisterForm extends Component
{
    #[Validate('required|email|unique:users')]
    public $email = '';

    #[Validate('required|min:8|max:100')]
    public $password = '';



    public function save(){
        $this->validate();

        $username = explode('@', $this->email)[0] . Carbon::now()->getTimestampMs();
        $profile_name = explode('@', $this->email)[0];

        $user = User::create([
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'name' => $username
        ]);

        $user->roles()->attach(1);

        Setting::create([
            'theme' => 1,
            'user_id' => $user->id,
        ]);

        Profile::create([
            'username' => $profile_name,
            'private' => 0,
            'user_id' => $user->id,
        ]);

        Auth::login();
        return redirect()->route('');
    }



    public function render()
    {
        return view('livewire.register-form');
    }
}
