<?php

namespace App\Livewire\Forms;

use App\Models\Like as ModelsLike;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class Like extends Form
{
    public function like(Post $post, User $user){
        $like = ModelsLike::where('user_id', '=', $user->id)->where('post_id', '=', $post->id)->first();
        
        if(!$like){
            ModelsLike::create(['user_id' => $user->id, 'post_id' => $post->id]);
            return;
        }

        $like->delete();
    }



    public function userHasLike(Post $post, User $user){
        if(!$user) return false;
        foreach($user->likes as $like) if($like->post_id === $post->id) return true;
        return false;
    }
}
