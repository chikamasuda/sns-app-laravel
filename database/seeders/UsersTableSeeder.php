<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => '1',
                'uid' => 'KII7H0IU8HSIgOPHCXvbxK0Gb4R2',
                'email' => 'chika20130920@yahoo.co.jp',
                'name' => 'ます',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '2',
                'uid' => 'QWRZYWq3cycBiJin0aivybZivMt2',
                'email' => 'test01@yahoo.co.jp',
                'name' => 'テストユーザー１',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
