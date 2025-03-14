<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class Delete extends Form
{
    public function delete($post_id){
        $post = Post::find($post_id);

        if(Auth::user()->id !== $post->profile->user->id) return redirect()->route('home');

        if($post->picture) $post->picture->delete();

        $post->delete();
    }


}
