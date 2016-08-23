<?php

use Illuminate\Database\Seeder;
use App\Models\Config;

class ConfigTableSeeder extends Seeder
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
                'code'=>'tab_info',
                'type'=>'group'
            ],[
                'code'=>'tab_basic',
                'type'=>'group'
            ],[
            'parent_id'=>1,
            'code'=>'web_title',
            'type'=>'text',
            'value'=>'复利系统'
        ],[
            'parent_id'=>1,
            'code'=>'web_desc',
            'type'=>'text',
            'value'=>'复利系统'
        ],[
            'parent_id'=>1,
            'code'=>'web_keys',
            'type'=>'text',
            'value'=>'复利系统'
        ]];
        foreach ($lists as $list) {
            Config::create($list);
        }
    }
}
