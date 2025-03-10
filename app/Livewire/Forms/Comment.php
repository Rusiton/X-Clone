<?php

namespace App\Livewire\Forms;

use App\Models\Comment as ModelsComment;
use App\Models\Post;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class Comment extends Form
{
    #[Validate('required|max:300')]
    public $comment;



    public function comment(Post $post, User $user){
        $this->validateOnly('comment');

        ModelsComment::create([
            'user_id' => $user->id,
            'post_id' => $post->id,
            'text' => $this->comment,
        ]);

        $this->reset('comment');
    }
}
