<?php
namespace xing;

/**
 * base class of controller
 */

class Controller{
    /**
     * @var array 渲染到模板的变量
     */
    protected $data;
    /**
     * @var string 控制器名称
     */
    protected $controller_name;
    /**
     * @var string Action name
     */
    protected $view_name;
    /**
     * @var string the root dir fo views file
     */
    protected $temp_dir;

    public function __construct($controller_name,$view_name){
        $this->controller_name = $controller_name;
        $this->view_name = $view_name;
        $this->temp_dir = BASE_PATH . '/templates';
    }

    /**
     * assign value for view
     * @param $key
     * @param $value
     */
    function assign($key,$value){
        $this->data[$key] = $value;
    }

    /**
     * include view file
     * @param string $file
     */
    function display($file = ''){
        if(empty($file)){
            $file = strtolower($this->controller_name) . '/' . $this->view_name .'.php';
        }
        extract($this->data);
        $path = $this->temp_dir . '/' . $file;
        require($path);
    }
}