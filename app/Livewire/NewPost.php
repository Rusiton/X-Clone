<?php

namespace App\Livewire;

use App\Models\Picture;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]
class NewPost extends Component
{
    use WithFileUploads;

    public User $user;

    #[Validate('required|max:300')]
    public $text;

    #[Validate('nullable|image|max:2048|dimensions:max_height:630')]
    public $image;

    #[Validate('array')]
    #[Validate('max:10', message: 'You may choose a maximum of 10 tags')]
    public $tags = [];


    public $random_tags;



    public function getImage(){
        return $this->image ? $this->image->temporaryUrl() : false;
    }



    public function getTag($tag_id){
        return Tag::find($tag_id);
    }



    public function removeTag($tag_id){
        $this->tags = array_diff($this->tags, [$tag_id]);
    }



    public function save(){
        $this->validate();

        $post = Post::create([ 
            'text' => $this->text,
            'profile_id' => $this->user->profile->id,
        ]);

        if($this->tags) $post->tags()->attach($this->tags);

        if($this->image){
            Picture::create([
                'pictureable_id' => $post->id,
                'pictureable_type' => 'App\Models\Post',
                'url' => $this->image->store('posts'),
            ]);
        }

        return redirect()->route('home');
    }



    public function mount(){
        if(!Auth::user()) return redirect()->route('login');
        $this->user = Auth::user();
        $this->random_tags = Tag::inRandomOrder()->take(25)->get();
    }



    public function render()
    {
        return view('livewire.new-post');
    }
}
