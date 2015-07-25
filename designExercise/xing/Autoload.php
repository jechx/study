<?php
namespace xing;
/**
 * 自动加载类
 */

class Autoload{
    /**
     * @param sting the class needed to load
     */
    public static function load($class){
        require(BASE_PATH . '/' .str_replace('\\','/',$class) . '.php');
    }
}