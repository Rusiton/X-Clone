<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Report;
use App\Models\Role;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::deleteDirectory('posts');
        Storage::deleteDirectory('profile_pictures');
        Storage::deleteDirectory('banners');

        Storage::makeDirectory('posts');
        Storage::makeDirectory('profile_pictures');
        Storage::makeDirectory('banners');

        Tag::factory(10)->create();

        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);

        $this->call(ProfileSeeder::class);

        $this->call(FollowSeeder::class);

        $this->call(PostSeeder::class);

        $this->call(LikeSeeder::class);

        $this->call(CommentSeeder::class);

        $this->call(RepostSeeder::class);

        $this->call(MentionSeeder::class);

        Report::factory(15)->create();
    }
}
