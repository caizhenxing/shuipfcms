<?php

/**
 * 插件配置，下面是示例
 * Some rights reserved：abc3210.com
 * Contact email:admin@abc3210.com
 */
return array(
    'allowcomments' => array(
        'title' => '是否允许留言：',
        'type' => 'radio',
        'options' => array(
            '1' => '允许',
            '0' => '不允许'
        ),
        'value' => '1'
    ),
    'mailreply' => array(
        'title' => '开启邮件回复：',
        'type' => 'radio',
        'options' => array(
            '1' => '开启',
            '0' => '关闭'
        ),
        'value' => '0'
    ),
    'ismember' => array(
        'title' => '只允许会员留言：',
        'type' => 'radio',
        'options' => array(
            '1' => '开启',
            '0' => '关闭'
        ),
        'value' => '0'
    ),
    'captcha' => array(
        'title' => '开启验证码：',
        'type' => 'radio',
        'options' => array(
            '1' => '开启',
            '0' => '关闭'
        ),
        'value' => '0'
    ),
);
