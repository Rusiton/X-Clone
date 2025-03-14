<?php

namespace App\Livewire;

use App\Livewire\Forms\Like;
use App\Livewire\Forms\Repost;
use App\Models\Post as ModelsPost;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Post extends Component
{
    public $post;
    public $user;

    public Like $like;
    public Repost $repost;



    public function openReportModal($reportable_id, $model){
        $this->dispatch('openReportModal', reportable_id: $reportable_id, model: $model);
    }


    public function openDeleteModal(ModelsPost $post){
        $this->dispatch('openDeleteModal', post: $post);
    }



    public function userHasLike(ModelsPost $post){
        if(!$this->user) return false;
        return $this->like->userHasLike($post, $this->user);
    }



    public function liked($post_id){
        if(!$this->user) return redirect()->route('login');
        $this->like->like($post_id, $this->user);
    }



    public function userHasRepost(ModelsPost $post){
        if(!$this->user) return false;
        return $this->repost->userHasRepost($post, $this->user);
    }



    public function reposted($post_id){
        if(!$this->user) return redirect()->route('login');
        $this->repost->repost($post_id, $this->user);
    }



    public function mount(){
        $this->user = Auth::user();
    }
    

    
    public function render()
    {
        return view('livewire.post');
    }
}
