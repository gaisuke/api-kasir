<?php

namespace Database\Seeders;

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
        User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@mailnesia.com',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'name' => 'Jena Doe',
            'email' => 'jenadoe@mailnesia.com',
            'password' => bcrypt('password'),
        ]);
    }
}
