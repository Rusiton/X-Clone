<?php

namespace Database\Seeders;

use App\Models\Picture;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::factory(50)->create();

        Post::all()->each(function ($post) {
            $tags = Tag::all()->random(3);

            // Picture::create([
            //     'pictureable_id' => $post->id,
            //     'pictureable_type' => 'App\Models\Post',
            //     'url' => 'posts/' . fake()->image('public/storage/posts', 640, 480, null, false),
            // ]);

            $post->tags()->attach($tags);
        });
    }
}
