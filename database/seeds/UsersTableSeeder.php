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
            'user_type' => '正社員',
            'is_working' => 0
        ]);

        DB::table('users')->insert([
            'name' => 'ビル・ゲイツ',
            'user_type' => 'アルバイト',
            'is_working' => 0
        ]);
    }
}
