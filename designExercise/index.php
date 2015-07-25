<?php
/**
 * 入口文件
 */

define('BASE_PATH',__DIR__);
require(BASE_PATH . '/xing/Autoload.php');
require('D:/wamp/www\func.php');

error_reporting(E_WARNING | E_ERROR);
//注册自动加载类
spl_autoload_register('\xing\Autoload::load');

xing\Application::getInstance(BASE_PATH)->dispatch();