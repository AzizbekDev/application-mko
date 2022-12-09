<?php

use App\Models\PartnerGroup;
use Illuminate\Database\Seeder;

class PartnerGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $partner_groups = [
            [
                'id'          => 1,
                'name'        => 'mobile',
                'title'       => 'Unired Mobile',
                'badge_color' => '#733AE8'
            ],
            [
                'id'          => 2,
                'name'        => 'mediapark',
                'title'       => 'Mediapark',
                'badge_color' => '#FF0000'
            ],
            [
                'id'          => 3,
                'name'        => 'idea',
                'title'       => 'IDEA',
                'badge_color' => '#800000'
            ],
            [
                'id'          => 4,
                'name'        => 'smartech',
                'title'       => 'Mediapark',
                'badge_color' => '#FFFF00'
            ],
            [
                'id'          => 5,
                'name'        => 'smartcredit',
                'title'       => 'SMARTCREDIT',
                'badge_color' => '#00008B'
            ],
            [
                'id'          => 6,
                'name'        => 'zoodmall',
                'title'       => 'Zoodmall',
                'badge_color' => '#ADD8E6'
            ],
            [
                'id'          => 7,
                'name'        => 'zoodmall',
                'title'       => 'Zoodmall',
                'badge_color' => '#800080'
            ],
            [
                'id'          => 8,
                'name'        => 'arenamarkaz',
                'title'       => 'Arena Markaz',
                'badge_color' => '#00FF00'
            ],
            [
                'id'          => 9,
                'name'        => 'sts',
                'title'       => 'STS',
                'badge_color' => '#FF00FF'
            ],
            [
                'id'          => 10,
                'name'        => 'variant',
                'title'       => 'Variant',
                'badge_color' => '#FFC0CB'
            ],
            [
                'id'          => 11,
                'name'        => 'mebeltexno',
                'title'       => 'Mebel Texno',
                'badge_color' => '#C0C0C0'
            ],
            [
                'id'          => 12,
                'name'        => 'lifecredit',
                'title'       => 'Life Credit',
                'badge_color' => '#808080'
            ],
            [
                'id'          => 13,
                'name'        => 'creditonline',
                'title'       => 'Credit Online',
                'badge_color' => '#000000'
            ],
            [
                'id'          =>  14,
                'name'        => 'engarzon',
                'title'       => 'Engarzon',
                'badge_color' => '#FFA500'
            ],
            [
                'id'          => 15,
                'name'        => 'mycom',
                'title'       => 'MYCOM',
                'badge_color' => '#A52A2A'
            ],
            [
                'id'          => 16,
                'name'        => 'thompsonmobile',
                'title'       => 'Thompson Mobile',
                'badge_color' => '#008000'
            ],
            [
                'id'          => 17,
                'name'        => 'callcenter',
                'title'       => 'Call_Center',
                'badge_color' => '#808000'
            ],
            [
                'id'          => 18,
                'name'        => 'artelsavdoinvest',
                'title'       => 'Artel Savdo Invest',
                'badge_color' => '#7FFD4'
            ]
        ];

        PartnerGroup::insert($partner_groups);
    }
}
