<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //
        $lists = [[
            'name' => '101',
            'password' => \Hash::make('111111'),
            'password2' => \Hash::make('111111'),
            'is_pass' => 1,
            'point1' => 1000,
            'point2' => 1000,
        ], [
            'name' => '102',
            'parent_id' => 1,
            'password' => \Hash::make('111111'),
            'password2' => \Hash::make('111111'),
            'point1' => 1000,
            'point2' => 1000,
        ], [
            'name' => '103',
            'parent_id' => 2,
            'password' => \Hash::make('111111'),
            'password2' => \Hash::make('111111'),
            'point1' => 1000,
            'point2' => 1000,
        ], [
            'name' => '104',
            'parent_id' => 3,
            'password' => \Hash::make('111111'),
            'password2' => \Hash::make('111111'),
            'point1' => 1000,
            'point2' => 1000,
        ], [
            'name' => '105',
            'parent_id' => 4,
            'password' => \Hash::make('111111'),
            'password2' => \Hash::make('111111'),
            'point1' => 1000,
            'point2' => 1000,
        ], [
            'name' => '106',
            'parent_id' => 5,
            'password' => \Hash::make('111111'),
            'password2' => \Hash::make('111111'),
            'point1' => 1000,
            'point2' => 1000,
        ], [
            'name' => '107',
            'parent_id' => 6,
            'is_pass' => 1,
            'password' => \Hash::make('111111'),
            'password2' => \Hash::make('111111'),
            'point1' => 1000,
            'point2' => 1000,
        ]];
        foreach ($lists as $list) {
            User::create($list);
        }
    }
}
