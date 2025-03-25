<?php

namespace App\Livewire\Forms;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class Delete extends Form
{
    public function delete($id, $type){
        if($type === 'Post'){
            $element = Post::find($id);

            if(Auth::user()->id !== $element->profile->user->id) return redirect()->route('home');

            if($element->picture) $element->picture->delete();
            $element->delete();
        }

        if($type === 'Comment'){
            $element = Comment::find($id);

            if(Auth::user()->id !== $element->user->id) return redirect()->route('home');
            $element->delete();
        }
    }


}
