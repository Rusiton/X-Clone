<?php

namespace Database\Seeders;

use App\Models\Mention;
use App\Models\Post;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MentionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::all()->each(function ($post) {
            $user = User::all()->random();
            $profile = Profile::all()->random();

            Mention::create([
                'user_id' => $user->id,
                'post_id' => $post->id,
                'profile_id' => $profile->id,
            ]);
        });
    }
}
