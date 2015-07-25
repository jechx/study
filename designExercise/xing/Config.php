<?php
namespace xing;

/**
 * 配置文件帮助类
 * implements \ArrayAccess:提供像访问数组一样访问对象的能力的接口。
 */

class Config implements \ArrayAccess{
    protected $path;
    protected $config;

    public function __construct($path){
        $this->path = $path;
    }

    public function offsetGet($key){
        if(empty($this->config[$key])){
            $file_path =  $this->path . '/' . $key . '.php';
            $config = require($file_path);
            $this->config[$key] = $config;
        }
        return $this->config[$key];
    }

    public function offsetSet($key,$value){
        throw new \Exception('Can not set config by write');
        //$this->config[$key] = $value;
    }

    public function offsetExists($key){
        return array_key_exists($key,$this->config);
    }

    public function offsetUnset($key){
        unset($this->config[$key]);
    }
}