<?php

namespace App\Livewire;

use App\Livewire\Forms\Follow as FormsFollow;
use App\Models\Follow;
use Livewire\Component;

class FollowButton extends Component
{
    public $user;
    public $profile;

    public $state = false;
    public FormsFollow $form_follow;


    public function follow(){
        if(!$this->user) return redirect()->route('login');
        $this->state = $this->form_follow->follow($this->user, $this->profile);
    }



    public function mount(){
        if($this->user && Follow::where('user_id', $this->user->id)->where('profile_id', $this->profile->id)->first()){
            $this->state = true;
        }
    }



    public function render()
    {
        return view('livewire.follow-button');
    }
}
