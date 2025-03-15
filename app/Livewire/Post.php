<?php

namespace App\Livewire;

use App\Livewire\Forms\Like;
use App\Livewire\Forms\Repost;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Post extends Component
{
    public $post;
    public $user;

    public Like $like;
    public Repost $repost;



    public function openReportModal(){
        $this->dispatch('openReportModal', reportable_id: $this->post->id, model: 'post');
    }


    public function openDeleteModal(){
        $this->dispatch('openDeleteModal', post: $this->post);
    }



    public function userHasLike(){
        if(!$this->user) return false;
        return $this->like->userHasLike($this->post, $this->user);
    }



    public function userHasRepost(){
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
