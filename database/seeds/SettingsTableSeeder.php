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
                    'url'           => env('MYID_URL', 'MYID_URL'),
                    'username'      => env('MYID_USERNAME', 'MYID_USERNAME'),
                    'password'      => env('MYID_PASSWORD', 'MYID_PASSWORD'),
                    'grant_type'    => env('MYID_GRANT_TYPE', 'MYID_GRANT_TYPE'),
                    'client_id'     => env('MYID_CLIENT_ID', 'MYID_CLIENT_ID'),
                    'client_secret' => env('MYID_CLIENT_SECRET', 'MYID_CLIENT_SECRET')
                ])
            ],
            [
                'id'             => 2,
                'name'           => 'tax',
                'description'    => 'Tax service settings',
                'value'          => json_encode([
                    'url'           => env('TAX_URL', 'TAX_URL'),
                    'username'      => env('TAX_USERNAME', 'TAX_USERNAME'),
                    'password'      => env('TAX_PASSWORD', 'TAX_PASSWORD')
                ])
            ],
            [
                'id'             => 3,
                'name'           => 'sms_gateway',
                'description'    => 'SMS service settings',
                'value'          => json_encode([
                    'url'           => env('SMS_URL', 'SMS_URL'),
                    'username'      => env('SMS_USERNAME', 'SMS_USERNAME'),
                    'password'      => env('SMS_PASSWORD', 'SMS_PASSWORD')
                ])
            ],
            [
                'id'             => 4,
                'name'           => 'katm',
                'description'    => 'KATM service settings',
                'value'          => json_encode([
                    'katm_url'      => env('KATM_URL', 'KATM_URL'),
                    'asoki_url'     => env('ASOKI_URL', 'ASOKI_URL'),
                    'username'      => env('KATM_USERNAME', 'KATM_USERNAME'),
                    'password'      => env('KATM_PASSWORD', 'KATM_PASSWORD'),
                    'head'          => 'MKO',
                    'code'          => '06101',
                    'type'          => 'T'
                ])
            ],
            [
                'id'             => 5,
                'name'           => 'card_scoring',
                'description'    => 'Card Scoring HUMO/UZCARD service settings',
                'value'          => json_encode([
                    'url'           => env('CARD_MONITORING_URL', 'CARD_MONITORING_URL'),
                    'username'      => env('CARD_MONITORING_USERNAME', 'CARD_MONITORING_USERNAME'),
                    'password'      => env('CARD_MONITORING_PASSWORD', 'CARD_MONITORING_PASSWORD')
                ])
            ],
            [
                'id'             => 6,
                'name'           => 'card_info',
                'description'    => 'Card Info HUMO/UZCARD service settings',
                'value'          => json_encode([
                    'url'           => env('CARD_INFO_URL', 'CARD_INFO_URL'),
                    'username'      => env('CARD_INFO_USERNAME', 'CARD_INFO_USERNAME'),
                    'password'      => env('CARD_INFO_PASSWORD', 'CARD_INFO_PASSWORD')
                ])
            ]
        ];
        Setting::insert($settings);
    }
}
