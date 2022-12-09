<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Supper Admin',
                'phone'          => '999986352',
                'email'          => 'supper_admin@unired.uz',
                'password'       => Hash::make('P@ssword01'),
            ],
            [
                'id'             => 2,
                'name'           => 'Admin',
                'phone'          => '712001110',
                'email'          => 'admin-mko@unired.uz',
                'password'       => Hash::make('password'),
            ],
            [
                'id'             => 3,
                'name'           => 'Manager',
                'phone'          => '712316000',
                'email'          => 'manager-mko@unired.uz',
                'password'       => Hash::make('password'),
            ],
            [
                'id'             => 4,
                'name'           => 'User',
                'phone'          => '999986353',
                'email'          => 'user@unired.uz',
                'password'       => Hash::make('password'),
            ],
        ];

        User::insert($users);
    }
}
