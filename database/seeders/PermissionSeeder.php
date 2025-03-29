<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'Delete posts',
            'Delete comments',
            'Ban profiles',
            'Ban tags',
        ];

        foreach ($names as $name) {
            DB::table('permissions')->insert([
                'name' => $name,
            ]);
        }
    }
}
