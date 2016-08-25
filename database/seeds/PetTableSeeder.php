<?php

use Illuminate\Database\Seeder;
use App\Models\Pet;

class PetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $lists=[[
            'title'=>'蓝冰',
            'image'=>'',
            'point2_day'=>9,
            'life'=>7,
            'money'=>55,
            'min_level'=>0,
            'buy_limit'=>10,
            'max_limit'=>80
        ]];
        foreach ($lists as $list) {
            Pet::create($list);
        }
    }
}
