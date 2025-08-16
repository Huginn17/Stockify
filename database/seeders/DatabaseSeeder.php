<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Categories;
use App\Models\Suppliers;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $userdata = [
            [
                'name' => 'gilang',
                'email' => 'gilang@gmail.com',
                'password' => Hash::make('123'),
                'role' => 'manajer_cabang'
            ],
            [
                'name' => 'holis',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123'),
                'role' => 'admin'
            ],
            [
                'name' => 'adrian',
                'email' => 'rifki@gmail.com',
                'password' => Hash::make('123'),
                'role' => 'staff_gudang'
            ]
            ];
            foreach ($userdata as $key =>  $val) {
                User::create($val);
            }

            Categories::create([
                'name' => 'Mobil',
                'description' => 'Mantap'
            ]);

             Categories::create([
                'name' => 'Motor',
                'description' => 'Mantap'
            ]);

             Categories::create([
                'name' => 'becak',
                'description' => 'Mantap'
            ]);

            Suppliers::create([
                'name' => 'Honda',
                'address' => 'Mantap',
                'phone' => '0812345678',
                'email' => 'honda@gmail.com'
            ]);
    }
}
