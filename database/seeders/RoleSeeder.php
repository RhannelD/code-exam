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
        $users = User::limit(8)->get();

        foreach ($users as $user) {
            Role::factory()->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
