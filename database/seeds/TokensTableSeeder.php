<?php

use Illuminate\Database\Seeder;
use App\Models\Token;

class TokensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tokens = [
            [
                'id'               => 1,
                'name'             => 'myid',
                'access_token'     => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE2NzEwOTA3NzcsInN1YiI6IntcImNsaWVudF9pZFwiOiBcInBheWxhdGVyX2lucGxhY2UtU2NNRkVpNk9GVlhVMHRYOUtKVVVDVGlOT280RmpaMTZNOWg2NmMyWlwiLCBcInVzZXJfaWRcIjogMjE3NjEsIFwic2NvcGVzXCI6IFwiY29tbW9uX2RhdGEsZG9jX2RhdGEsY29udGFjdHMsYWRkcmVzc1wiLCBcImFjY2Vzc190b2tlblwiOiB0cnVlfSJ9.GkV4W1KPJps76VrMc0gUgX5FdFDFYomA88PRNcCM0Vk',
                'expires_in'       => 3600,
                'refresh_token'    => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE2NzM2NzkxNzcsInN1YiI6IntcImNsaWVudF9pZFwiOiBcInBheWxhdGVyX2lucGxhY2UtU2NNRkVpNk9GVlhVMHRYOUtKVVVDVGlOT280RmpaMTZNOWg2NmMyWlwiLCBcInVzZXJfaWRcIjogMjE3NjEsIFwic2NvcGVzXCI6IFwiY29tbW9uX2RhdGEsZG9jX2RhdGEsY29udGFjdHMsYWRkcmVzc1wiLCBcInJlZnJlc2hfdG9rZW5cIjogdHJ1ZX0ifQ.3tMonxUom8rfDeyoDSKsiIFSTCcd1XLrzGhVNFxXrLw',
                'active'           => 1,
                'token_expires_at' => '2022-12-15 12:52:57',
            ],
            [
                'id'               => 2,
                'name'             => 'card_scoring',
                'access_token'     => '$2y$10$MfTug6env0D3OHA.JYH1feGntmVceljClQBy8HeGuuFirKbIY7b12',
                'expires_in'       => 3600,
                'refresh_token'    => '$2y$10$MfTug6env0D3OHA.JYH1feGntmVceljClQBy8HeGuuFirKbIY7b12',
                'active'           => 1,
                'token_expires_at' => '2023-12-19 09:43:16',
            ],
            [
                'id'               => 3,
                'name'             => 'card_info',
                'access_token'     => 'fa0e1982-6228-4823-b53b-bbcbd58031f7-46007c94-5712-41d3-8571-aa42b44bddba',
                'expires_in'       => 3600,
                'refresh_token'    => 'fa0e1982-6228-4823-b53b-bbcbd58031f7-46007c94-5712-41d3-8571-aa42b44bddba',
                'active'           => 1,
                'token_expires_at' => '2023-12-19 09:43:16',
            ]
        ];

        Token::insert($tokens);
    }
}
