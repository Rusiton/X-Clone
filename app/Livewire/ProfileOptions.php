<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProfileOptions extends Component
{
    public $profile;
    public $user;



    public function logout(){
        Auth::logout();
        return redirect()->route('landing');
    }



    public function openReportModal(){
        $this->dispatch('open-report-modal', reportable_id: $this->profile->id, model: 'Profile');
    }

    public function render()
    {
        return view('livewire.profile-options');
    }
}
