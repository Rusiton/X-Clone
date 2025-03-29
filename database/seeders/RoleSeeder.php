<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'User',
            'Administrator',
        ];

        foreach ($names as $name) {
            DB::table('roles')->insert([
                'name' => $name,
            ]);
        }

        $role = Role::where('name', 'Administrator')->first();
        $role->permissions()->attach([1, 2, 3, 4]);
    }
}
