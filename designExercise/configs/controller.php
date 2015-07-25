<?php

/**
 * 控制器配置
 */

return  array(
    'home' => array(
        'decorator' => array('\\App\\Decorator\\Login'),
    ),
    'index'=>array(
        'decorator' => array('\\App\\Decorator\\Login'),
    ),
    'default' => 'Index/index',
);