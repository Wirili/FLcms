<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2016/5/11
 * Time: 16:01
 */
return [
    'name' => '玩家编号',
    'fullname' => '玩家姓名',
    'parent' => '上级编号',
    'child_count' => '直荐人数',
    'is_pass' => '激活状态',
    'is_pass_option' => [
        0=>'未激活',
        1=>'已激活',
    ],
    'is_lock' => '账号状态',
    'is_lock_option' => [
        0=>'正常',
        1=>'已锁定',
    ],
    'level_label'=>'等级',
    'level'=>[
        1=>'<span class="label label-default">VIP</span>',
        2=>'<span class="label label-danger">VIP1</span>',
        3=>'<span class="label label-danger">VIP2</span>',
        4=>'<span class="label label-danger">VIP3</span>',
        5=>'<span class="label label-danger">VIP4</span>',
    ],
    'point2' => '金币余额',
    'point2sum' => '金币收益',
    'point1'=>'激活币',
    'referral_link'=>'推广链接',
    'click_copy'=>'点击复制',
];