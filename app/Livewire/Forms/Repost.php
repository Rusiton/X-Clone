<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use App\Models\Repost as ModelsRepost;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class Repost extends Form
{
    public function repost(Post $post, User $user){
        $repost = ModelsRepost::where('user_id', '=', $user->id)->where('post_id', '=', $post->id)->first();

        if(!$repost){
            ModelsRepost::create(['user_id' => $user->id, 'post_id' => $post->id]);
            return;
        }

        $repost->delete();
    }

    public function userHasRepost(Post $post, User $user){
        if(!$user) return false;
        foreach($user->reposts as $repost) if($repost->post_id === $post->id) return true;
        return false;
    }
}
