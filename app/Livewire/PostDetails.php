<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post as ModelsPost;
use App\Models\Report;
use App\Models\Repost;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PostDetails extends Component
{
    public $user;
    public $post;

    public $already_reported;
    public $report_open = false;
    public $report_post;

    #[Validate('required|min:15|max:300')]
    public $report_reason;

    #[Validate('required|max:300')]
    public $comment;



    public function openReportModal(ModelsPost $post){
        if(!$this->user) return redirect()->route('login');

        $this->report_post = $post;

        if(Report::where('user_id', $this->user->id)
                ->where('reportable_id', $this->report_post->id)
                ->where('reportable_type', 'App\Models\Post')
                ->exists()
        ){
            $this->already_reported = true;
        }

        $this->report_open = true;
    }



    public function reported(){
        if(!$this->user) return redirect()->route('login');

        if($this->already_reported) return;

        $this->validateOnly('report_reason');

        Report::create([
            'user_id' => $this->user->id,
            'reportable_type' => 'App\Models\Post',
            'reportable_id' => $this->report_post->id,
            'reason' => $this->report_reason,
        ]);

        $this->reset(['report_open', 'report_post', 'report_reason']);
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



    public function addComment(){
        if(!$this->user) return;

        $this->validateOnly('comment');

        Comment::create([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
            'text' => $this->comment,
        ]);

        $this->reset('comment');
    }

    
    public function render()
    {
        $this->user = Auth::user();

        return view('livewire.post-details');
    }
}
