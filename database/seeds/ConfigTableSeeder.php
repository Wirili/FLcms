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
            'code'=>'tab_recommend',
            'type'=>'group'
        ],[
            'code'=>'tab_level',
            'type'=>'group'
        ],[
            'code'=>'tab_withdraw',
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
        ],[
            'parent_id'=>1,
            'code'=>'web_close',
            'type'=>'select',
            'store_range'=>'0,1',
            'value'=>'1'
        ],[
            'parent_id'=>1,
            'code'=>'web_qq',
            'type'=>'text',
            'value'=>'1'
        ],[
            'parent_id'=>3,
            'code'=>'point2rem.1',
            'type'=>'text',
            'value'=>'1'
        ],[
            'parent_id'=>3,
            'code'=>'point2rem.2',
            'type'=>'text',
            'value'=>'1'
        ],[
            'parent_id'=>3,
            'code'=>'point2rem.3',
            'type'=>'text',
            'value'=>'1'
        ],[
            'parent_id'=>3,
            'code'=>'point2rem.4',
            'type'=>'text',
            'value'=>'1'
        ],[
            'parent_id'=>3,
            'code'=>'point2rem.5',
            'type'=>'text',
            'value'=>'1'
        ],[
            'parent_id'=>3,
            'code'=>'user_reg',
            'type'=>'text',
            'value'=>'1'
        ],[
            'parent_id'=>3,
            'code'=>'user_act',
            'type'=>'text',
            'value'=>'1'
        ],[
            'parent_id'=>3,
            'code'=>'user_act_point1',
            'type'=>'text',
            'value'=>'50'
        ],[
            'parent_id'=>3,
            'code'=>'user_act_point2',
            'type'=>'text',
            'value'=>'20'
        ],[
            'parent_id'=>4,
            'code'=>'level.1',
            'type'=>'text',
            'value'=>'0'
        ],[
            'parent_id'=>4,
            'code'=>'level.2',
            'type'=>'text',
            'value'=>'10'
        ],[
            'parent_id'=>4,
            'code'=>'level.3',
            'type'=>'text',
            'value'=>'20'
        ],[
            'parent_id'=>4,
            'code'=>'level.4',
            'type'=>'text',
            'value'=>'50'
        ],[
            'parent_id'=>4,
            'code'=>'level.5',
            'type'=>'text',
            'value'=>'100'
        ],[
            'parent_id'=>5,
            'code'=>'withdraw_fee',
            'type'=>'text',
            'value'=>'10'
        ],[
            'parent_id'=>5,
            'code'=>'withdraw_member',
            'type'=>'text',
            'value'=>'0'
        ],[
            'parent_id'=>5,
            'code'=>'withdraw_minmoney',
            'type'=>'text',
            'value'=>'100'
        ]];
        foreach ($lists as $list) {
            Config::create($list);
        }
    }
}
