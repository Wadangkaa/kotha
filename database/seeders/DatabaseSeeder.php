<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Kotha;
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
        User::create([
            'name' => "David Chamling Rai",
            'email' => 'admin@gmail.com',
            'password' => 'admin',
            'is_admin' => 1
        ]);
        User::create([
            'name' => "User",
            'email' => 'user@gmail.com',
            'password' => 'user',
        ]);

        User::factory(10)->create();
        Kotha::factory(1000)
        ->hasimages(3)
        ->hascontact()
        ->haslocation()
        ->hasmap()
        ->hasadditionalInfo()
        ->create([
            'status' => 'approved'
        ]);
    }
}
