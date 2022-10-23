<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Barang;
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
        // \App\Models\User::factory(10)->create();

        Barang::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Rio Pambudhi',
            'email' => 'riopambudhi51@gmail.com',
            'password'  => bcrypt('12345')
        ]);
    }
}
