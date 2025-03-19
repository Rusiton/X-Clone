<?php

namespace App\Livewire;

use App\Livewire\Forms\Like;
use App\Livewire\Forms\Repost;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Post extends Component
{
    public $called_from;
    public $search_characters;

    public $post;
    public $user;

    public Like $like;
    public Repost $repost;



    public function getHighlightedSearchCharacters(): string {
        return str_replace($this->search_characters, '<span class="font-bold">' .  $this->search_characters . '</span>', $this->post->text);
    }



    public function openReportModal(){
        $this->dispatch('openReportModal', reportable_id: $this->post->id, model: 'post');
    }


    public function openDeleteModal(){
        $this->dispatch('openDeleteModal', post: $this->post);
    }



    public function userHasLike(): bool {
        if(!$this->user) return false;
        return $this->like->userHasLike($this->post, $this->user);
    }



    public function userHasRepost(): bool {
        if(!$this->user) return false;
        return $this->repost->userHasRepost($this->post, $this->user);
    }



    public function mount(){
        $this->user = Auth::user();
    }
    

    
    public function render()
    {
        return view('livewire.post');
    }
}
