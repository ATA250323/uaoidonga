<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    // public function run(): void
    // {
    //     // User::factory(10)->create();

    //     User::factory()->create([
    //         'name' => 'Administrateur',
    //         'email' => 'admin@admin',
    //         'password' => bcrypt('p@ssw0rd'),
    //     ]);
    // }

     public function run(): void
    {
        // User::factory(10)->create();
        // $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);

        $admin = User::updateOrCreate(
            [
                'email' => 'abttoure@gmail.com',
            ],
            [
                'name' => 'Admin',
                'email' => 'abttoure@gmail.com',
                'password' => bcrypt('Ifsi250323@'),
            ]
        );
        $admin->assignRole('Super-Administrateur');
    }
}
