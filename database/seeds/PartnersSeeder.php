<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Partner;

class PartnersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $partners = [
            [
                'id'                => 1,
                'partner_group_id'  => 2,
                'nickname'          => 'Test MediaPark',
                'phone'             => '991234567',
                'email'             => 'test_mediapark@unired.uz',
                'password'          => Hash::make('unired_t123'),
                'logo'              => 'mediapark.png',
                'rest_login'        => 'test_mediapark',
                'rest_password'     => 'test_123',
                'is_admin'          => true,
                'is_online'         => true
            ],
            [
                'id'                => 2,
                'partner_group_id'  => 1,
                'nickname'          => 'Test Unired Mobile',
                'phone'             => '999986352',
                'email'             => 'test_unired_mobile@unired.uz',
                'password'          => Hash::make('unired_mobile'),
                'logo'              => 'unired-mobile.png',
                'rest_login'        => 'test_unired_mobile',
                'rest_password'     => 'test_123',
                'is_admin'          => true,
                'is_online'         => true
            ]
        ];

        Partner::insert($partners);
    }
}
