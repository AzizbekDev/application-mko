<?php

use App\Models\ApiUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ApiUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id'               => 1,
                'name'             => 'Unired Mobile',
                'login'            => 'unired_mobile',
                'password'         => Str::random(5),
                'created_by'       => 1,
                'token'            => Str::uuid(),
                'token_expires_at' => Carbon::now()->addDays(180)
            ]
        ];
        ApiUser::insert($users);
    }
}
