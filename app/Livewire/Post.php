<?php

namespace App\Livewire;

use App\Livewire\Forms\Like;
use App\Livewire\Forms\Repost;
use App\Models\Post as ModelsPost;
use Illuminate\Support\Facades\Auth;
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



    public function userHasLike(ModelsPost $post){
        return $this->like->userHasLike($post, $this->user);
    }



    public function liked(ModelsPost $post){
        if(!$this->user) return redirect()->route('login');
        $this->like->like($post, $this->user);
    }



    public function reposted(ModelsPost $post){
        if(!$this->user) return redirect()->route('login');
        $this->repost->repost($post, $this->user);
    }



    public function userHasRepost(ModelsPost $post){
        return $this->repost->userHasRepost($post, $this->user);
    }
    

    
    public function render()
    {
        $this->user = Auth::user();

        return view('livewire.post');
    }
}
