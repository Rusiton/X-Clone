<?php

namespace App\Livewire;

use App\Models\Follow;
use Livewire\Component;

class FollowButton extends Component
{
    public $user;
    public $profile;

    public $state = false;


    public function follow(){
        if($this->state){
            Follow::where('user_id', $this->user->id)
                ->where('profile_id', $this->profile->id)
                ->first()
                ->delete();
            
            $this->state = false;
            return;
        }

        $this->user->following()->syncWithoutDetaching([$this->profile->id]);
        $this->state = true;
    }



    public function mount(){
        if(Follow::where('user_id', $this->user->id)->where('profile_id', $this->profile->id)->first()){
            $this->state = true;
        }
    }



    public function render()
    {
        return view('livewire.follow-button');
    }
}
