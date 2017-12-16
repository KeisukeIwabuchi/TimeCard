<?php

use Illuminate\Database\Seeder;

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
            'name' => 'スティーブ・ジョブズ',
            'user_type' => '正社員'
        ]);

        DB::table('users')->insert([
            'name' => 'ビル・ゲイツ',
            'user_type' => 'アルバイト'
        ]);
    }
}
