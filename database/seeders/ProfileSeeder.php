<?php

namespace Database\Seeders;

use App\Models\Picture;
use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profile::factory(50)->create();

        Profile::all()->each(function ($profile) {
            Picture::create([
                'pictureable_id' => $profile->id,
                'pictureable_type' => 'App\Models\Profile',
                'url' => 'profile_pictures/' . fake()->image('public/storage/profile_pictures', 640, 480, null, false),
            ]);
        });
    }
}
