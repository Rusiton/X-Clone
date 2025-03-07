<?php

namespace App\Livewire;

use App\Models\Like;
use App\Models\Post as ModelsPost;
use App\Models\Repost;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Post extends Component
{
    public $post;
    public $user;



    public function openReportModal(ModelsPost $post){
        $this->dispatch('openReportModal', post: $post);
    }



    public function liked(ModelsPost $post){
        if(!$this->user) return redirect()->route('login');

        $like = Like::where('user_id', '=', $this->user->id)
                    ->where('post_id', '=', $post->id)
                    ->first();
        
        if(!$like){
            Like::create([
                'user_id' => $this->user->id,
                'post_id' => $post->id,
            ]);

            return;
        }

        $like->delete();
    }



    public function reposted(ModelsPost $post){
        if(!$this->user) return redirect()->route('login');

        $repost = Repost::where('user_id', '=', $this->user->id)
                    ->where('post_id', '=', $post->id)
                    ->first();

        if(!$repost){
            Repost::create([
                'user_id' => $this->user->id,
                'post_id' => $post->id,
            ]);

            return;
        }

        $repost->delete();
    }



    public function userHasLike(ModelsPost $post){
        if(!$this->user) return false;

        foreach($this->user->likes as $like){
            if($like->post_id === $post->id){
                return true;
            }
        }

        return false;
    }



    public function userHasRepost(ModelsPost $post){
        if(!$this->user) return false;

        foreach($this->user->reposts as $repost){
            if($repost->post_id === $post->id){
                return true;
            }
        }

        return false;
    }
    

    public function render()
    {
        $this->user = Auth::user();

        return view('livewire.post');
    }
}
