<?php

namespace Database\Seeders;

use App\Models\Roleetabli;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Super-Administrateur', 'guard_name' => 'web'],
            ['name' => 'Administrateur', 'guard_name' => 'web'],
            ['name' => 'Directeur', 'guard_name' => 'web'],
            ['name' => 'Secondaire', 'guard_name' => 'web'],
            ['name' => 'Primaire', 'guard_name' => 'web'],
        ];


        foreach ($roles as $role) {
        if (Role::where('name', $role['name'])->exists()) {
            continue;
        }

        $role['public_id'] = Str::uuid(); // 👈 ajoute un UUID

        Role::create($role);

    }
    }
}
