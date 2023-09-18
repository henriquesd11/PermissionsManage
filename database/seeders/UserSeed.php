<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::factory()->create(
            [
                'name' => 'Administrador',
                'email' => 'administrador@autogestor.com',
            ]
        );

        $admin->assignRole('admin');

        $common = User::factory()->create(
            [
                'name' => 'comum',
                'email' => 'comum@autogestor.com',
            ]
        );

        $common->assignRole('comum');
        $common->givePermissionTo('produtos');

        $common = User::factory()->create(
            [
                'name' => 'comum1',
                'email' => 'comum1@autogestor.com',
            ]
        );

        $common->assignRole('comum');
        $common->givePermissionTo('produtos');
        $common->givePermissionTo('categoria');

        $common = User::factory()->create(
            [
                'name' => 'comum2',
                'email' => 'comum2@autogestor.com',
            ]
        );

        $common->assignRole('comum');
        $common->givePermissionTo('produtos');
        $common->givePermissionTo('categoria');
        $common->givePermissionTo('marcas');
    }
}
