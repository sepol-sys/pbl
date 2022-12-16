<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $admin = User::create([
            'name' => 'Admin Role',
            'address' => 'jalan mantan',
            'handphone' => '1234567890',
            'gender' => 'laki laki',
            'username' => 'admin',
            'email' => 'Admin@Role.test',
            'password' => bcrypt('12345678'),
            'birth' => '2002',

        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'User Role',
            'address' => 'jalan bebas',
            'handphone' => '0987654321',
            'gender' => 'laki laki',
            'username' => 'user',
            'email' => 'user@Role.test',
            'password' => bcrypt('12345678'),
            'birth' => '2002',

        ]);

        $user->assignRole('User');
    }
}
