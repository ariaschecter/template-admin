<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run() : void
    {
        $roles = ['admin'];

        foreach ($roles as $role) {
            User::factory()->create([
                'name'  => $role,
                'email' => $role . '@gmail.com',
                'role'  => $role
            ]);
        }

        $this->call(SelectListSeeder::class);
    }
}
