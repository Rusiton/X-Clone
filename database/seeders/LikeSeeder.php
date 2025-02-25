<?php

namespace Database\Seeders;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::all()->each(function ($post) {
            $user = User::all()->except([Like::select('user_id')->get()])->random();

            Like::create([
                'user_id' => $user->id,
                'post_id' => $post->id,
            ]);

        });
    }
}
