<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\User::create([
            'name' => 'Administrator',
            'email' => 'admin@pos.com',
            'password' => bcrypt('secret'),
            'role_id' => 1
        ]);

        App\Models\User::create([
            'name' => 'User',
            'email' => 'user@pos.com',
            'password' => bcrypt('secret'),
            'role_id' => 2
        ]);
    }
}
