<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
        ]);

        $roles = Role::get();

        foreach ($roles as $key => $role) {
            if ($key==0) {
                User::factory()->create([
                    'role_id' => $role->id,
                    'full_name' => 'Rhannel Dinlasan',
                    'email_address' => 'rhannel@gmail.com',
                ]);
                continue;
            }
            User::factory()->create([
                'role_id' => $role->id
            ]);
        }
    }
}
