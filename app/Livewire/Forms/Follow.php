<?php

namespace App\Livewire\Forms;

use App\Models\Follow as ModelsFollow;
use App\Models\Profile;
use App\Models\User;
use Livewire\Form;

class Follow extends Form
{
    public function checkFollow($user_id, $profile_id){
        $currentFollow = 
            ModelsFollow::where('user_id', $user_id)
            ->where('profile_id', $profile_id)
            ->first();
    
        if($currentFollow) return $currentFollow;
        else return false;
    }



    public function follow(User $user, Profile $profile){
        if(!$user) return redirect()->route('login');
        
        $currentFollow = $this->checkFollow($user->id, $profile->id);

        if($currentFollow){
            $currentFollow->delete();
            return false;
        }

        $user->following()->syncWithoutDetaching([$profile->id]);
        return true;
    }
}