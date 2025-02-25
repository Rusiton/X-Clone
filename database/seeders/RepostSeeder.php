<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Repost;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RepostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::all()->each(function ($post) {
            $user = User::all()->except([Repost::select('user_id')->get()])->random();

            Repost::create([
                'user_id' => $user->id,
                'post_id' => $post->id,
            ]);
        });
    }
}
