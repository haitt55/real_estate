<?php

/**
 * Created by PhpStorm.
 * User: haitt
 * Date: 4/1/2017
 * Time: 2:18 PM
 */
use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        User::truncate();
        User::create([
            'name' => 'admin',
            'email' => 'admin',
            'password' => bcrypt('123456'),
        ]);
    }
}