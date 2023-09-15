<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            0 => [
                'name' => 'admin',
                'guard_name' => 'web',
            ],
            1 => [
                'name' => 'comum',
                'guard_name' => 'web',
            ]
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
