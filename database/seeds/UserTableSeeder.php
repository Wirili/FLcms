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
        $lists=[[
            'name'=>'101',
            'password'=>\Hash::make('111111')
        ],[
            'name'=>'102',
            'parent_id'=>1,
            'password'=>\Hash::make('111111')
        ]];
        foreach ($lists as $list) {
            User::create($list);
        }
    }
}