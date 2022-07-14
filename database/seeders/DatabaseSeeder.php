<?php

namespace Database\Seeders;

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
        User::factory()->create([
            'full_name' => 'Rhannel Dinlasan',
            'email_address' => 'rhannel@gmail.com',
        ]);

        User::factory(9)->create();

        $this->call([
            RoleSeeder::class,
        ]);
    }
}
