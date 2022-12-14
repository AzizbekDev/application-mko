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
                'value'          => json_encode([
                    'url'           => 'url',
                    'username'      => 'username',
                    'password'      => 'password'
                ])
            ],
            [
                'id'             => 3,
                'name'           => 'sms_gateway',
                'description'    => 'SMS service settings',
                'value'          => json_encode([
                    'url'           => 'url',
                    'username'      => 'username',
                    'password'      => 'password'
                ])
            ],
            [
                'id'             => 4,
                'name'           => 'katm',
                'description'    => 'KATM service settings',
                'value'          => json_encode([
                    'url'           => 'url',
                    'username'      => 'username',
                    'password'      => 'password'
                ])
            ],
            [
                'id'             => 5,
                'name'           => 'card_scoring',
                'description'    => 'Card Scoring HUMO/UZCARD service settings',
                'value'          => json_encode([
                    'url'           => 'url',
                    'username'      => 'username',
                    'password'      => 'password'
                ])
            ],
            [
                'id'             => 6,
                'name'           => 'card_info',
                'description'    => 'Card Info HUMO/UZCARD service settings',
                'value'          => json_encode([
                    'url'           => 'url',
                    'username'      => 'username',
                    'password'      => 'password'
                ])
            ]
        ];
        Setting::insert($settings);
    }
}
