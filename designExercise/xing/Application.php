<?php
namespace xing;

/**
 * 应用程序
 * 应用到了单利模式
 */
class Application{
    /**
     * @var object app实例
     */
    protected static $instance = null;
    /**
     * @var string 应用的基本路径
     */
    public $base_path;
    /**
     * @var array 应用配置
     */
    public $config;

    /**
     * 单例模式，构造函数不能为public，即不能用new关键字获得实例
     * @param string
     */
    private function __construct($base_path){
        $this->base_path = $base_path;
        $this->config = new Config($base_path . '/configs');
    }
    /**
     * 获取实例的唯一方式
     */
    public static function getInstance($base_path){
        if(! self::$instance){
            self::$instance =  new self($base_path);
        }

        return self::$instance;
    }
    /**
     * 制定跳转
     */
    public function dispatch(){
        $uri = $_SERVER['QUERY_STRING'];
        list($c,$v) = explode('/',trim($uri,'/'));
        $controller_config = $this->config['controller'];

        $c_low = strtolower($c);
        $c = ucwords($c);
        $class = "\\App\\Controllers\\" . $c;


        /**
         * 若访问不存在的控制器，
         * 则跳转到index/index;
         */
        if(!file_exists(BASE_PATH . $class . '.php')){
            //echo $class;exit;
            $query_string = $controller_config['default'];
            header('location:/index.php?' . $query_string);exit;
        }
        $obj = new $class($c,$v);
        //p($obj);

        $decorators = array();
        /**
         * 装饰器模式应用
         */
        if (isset($controller_config[$c_low]['decorator']))
        {
            $conf_decorator = $controller_config[$c_low]['decorator'];
            foreach($conf_decorator as $class)
            {
                $decorators[] = new $class;
            }
        }
        /**
         * do what before action here
         */
        foreach($decorators as $decorator)
        {
            $decorator->beforeRequest($obj);
        }
        $return_value = $obj->$v();
        /**
         * do what after action here
         */
        foreach($decorators as $decorator)
        {
            $decorator->afterRequest($return_value);
        }
    }

}
