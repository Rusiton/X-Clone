<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::factory(10)->create();
        Role::factory(5)->create();

        Role::all()->each(function ($role) {
            $permissions = Permission::orderByRaw('RAND()')->take(rand(1, count(Permission::all())))->get();
            $role->permissions()->attach($permissions);
        });
    }
}
