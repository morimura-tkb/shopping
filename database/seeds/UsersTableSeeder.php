<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [['太郎','taro@taro.com',bcrypt('test1234'),'2009-4-12'],
                    ['花子','hanako@hanako.com',bcrypt('sample1234'),'1970-8-24']];

        foreach ($users as $user) {
                DB::table('users')->insert([
                'name' => $user[0],
                'email' => $user[1],
                'password' => $user[2],
                'birthday' => $user[3],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
