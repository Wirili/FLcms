<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2016/5/11
 * Time: 16:01
 */
return [
    //farm
    'caption'=>':no号<span class="badge">:num</span>',
    'progress'=>':settle_len天',
    'detail'=>'已产金币：<strong>:settle_money</strong>/待产金币：<strong>:left_money</strong>',
    'add_time'=>'购买日期：:add_time',
    //farm_detail
    'total'=>[
        0=>'共有：',
        1=>'、',
    ],
    'label' => [
        'market' => '市场',
        'attr' => '属性',
        'settle' => '结算',
    ],
    'attr_text' => '<b>:title</b><br>
                    数量：:num<br>
                    每日生产金币数：:point2_day<br>
                    每日总共生产金币数：:point2_day_total<br>',
    'settle_text' => '购买时间：:add_time<br>
                    宠物寿命：:end_time<br>
                    已生产金币：:settle_len天，共:settle_money金币<br>
                    还可生产金币：:left_len天，共:left_money金币<br>',
];