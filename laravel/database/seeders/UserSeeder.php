<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
                // ゲストユーザー
                'name' => 'ゲストユーザー',
                'email' => 'guest@com',
                'password' => Hash::make('guestpassword'),
            ],
            [
                // テストユーザー
                'name' => 'テストユーザー',
                'email' => 'test@com',
                'password' => Hash::make('testtest'),
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }
    }
}
