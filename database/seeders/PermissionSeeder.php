<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
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
                'name' => 'produtos',
                'guard_name' => 'web',
            ],
            1 => [
                'name' => 'categoria',
                'guard_name' => 'web',
            ],
            2 => [
                'name' => 'marcas',
                'guard_name' => 'web',
            ],
        ];

        foreach ($roles as $role) {
            Permission::create($role);
        }
    }
}
