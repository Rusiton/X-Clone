<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index($id){
        $post = Post::find($id);
        
        return view('post', compact('post'));
    }
}
