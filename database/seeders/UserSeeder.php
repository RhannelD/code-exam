<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'role_id' => 1,
            'full_name' => 'Rhannel Dinlasan',
            'email_address' => 'rhannel@gmail.com',
        ]);

        $roles = Role::select('id')
            ->where('id', '!=', 1)
            ->get();

        foreach ($roles as $key => $role) {
            User::factory()->create([
                'role_id' => $role->id
            ]);
        }
    }
}
