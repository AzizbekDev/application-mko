<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            [
                'id'             => 1,
                'name'           => 'myid',
                'description'    => 'MyID service settings',
                'value'          => json_encode([
                    'url'           => 'url',
                    'username'      => 'username',
                    'password'      => 'password',
                    'grant_type'    => 'grant_type',
                    'client_id'     => 'client_id',
                    'client_secret' => 'client_secret'
                ])
            ],
            [
                'id'             => 2,
                'name'           => 'tax',
                'description'    => 'Tax service settings',
                'value'          => '',
            ],
            [
                'id'             => 3,
                'name'           => 'sms',
                'description'    => 'SMS service settings',
                'value'          => '',
            ],
            [
                'id'             => 4,
                'name'           => 'uzcard',
                'description'    => 'Uzcard service settings',
                'value'          => '',
            ],
            [
                'id'             => 5,
                'name'           => 'humo',
                'description'    => 'Humo service settings',
                'value'          => '',
            ]

        ];
        Setting::insert($settings);
    }
}
