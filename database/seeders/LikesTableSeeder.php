<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('likes')->insert([
            [
                'id' => '1',
                'user_id' => '1',
                'post_id' => '1',
                'uid' => 'KII7H0IU8HSIgOPHCXvbxK0Gb4R2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '2',
                'user_id' => '1',
                'post_id' => '2',
                'uid' => 'KII7H0IU8HSIgOPHCXvbxK0Gb4R2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '3',
                'user_id' => '2',
                'post_id' => '1',
                'uid' => 'QWRZYWq3cycBiJin0aivybZivMt2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
