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
        if(DB::table('users')->get()->count() == 0) {

            DB::table('users')->insert([
                'name' => 'Lucas Rosa',
                'email' => 'lucas-fbr@hotmail.com',
                'password' => bcrypt('123456'),
                'remember_token' => str_random(10),
            ]);

        }
    }
}
