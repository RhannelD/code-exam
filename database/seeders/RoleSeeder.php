<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
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
            "Admin",
            "General Manager",
            "Assistant Manager",
            "Accountant",
            "Administrative assistant",
            "IT technician",
            "Human resource manager",
            "Accounts Manager",
            "Recruitment Manager",
            "Technology Manager",
            "Store Manager",
            "Regional Manager",
            "Functional Manager",
            "Departmental Manager",
        ];

        foreach ($roles as $role) {
            Role::factory()->create([
                'role_name' => $role,
            ]);
        }
    }
}
