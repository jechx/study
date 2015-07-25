<?php

/**
  *调试用->输出函数
  *@param $data mixed
  *
  */
function p($data,$flag=true){
   echo "<pre>";
   if(is_array($data) || is_object($data)){
	print_r($data);
   }elseif(is_string($data)){
	echo $data;
   }else{
	   var_dump($data);
   }
   echo "</pre>";

   if($flag) exit;
}
 /**
  *调试用->写入文件操作
  *@param $str String
  *@param $fileName String
  */
function fw($data,$fileName="debug"){
    $fp = fopen(BASE_PATH."/".$fileName.".txt","a+");
    if(is_array($data)){
        foreach($data as $k=>$v){
             fwrite($fp,"\r\n".date('Y-m-d h:i:s ',time()).$k.'='.$v);
        }
    }else{
        fwrite($fp,$data);
    }
    fwrite($fp,"\r\n");
    fclose($fp);
}
// 递归转义数组
function _addslashes($arr) {
    foreach($arr as $k=>$v) {
        if(is_string($v)) {
            $arr[$k] = addslashes($v);
        } else if(is_array($v)) { // 再加判断,如果是数组,调用自身,再转
            $arr[$k] = _addslashes($v);
        }
    }

    return $arr;
}
/*
 *取多个不重复的随机数
 */
 function multi_rand($begin, $end, $count)
{
                $rand_array = array();
                if ( $count > ($end - $begin + 1)) {
                         $count = ($end - $begin + 1);
                }
                for ($i = 0;$i < $count; $i++ ) {
                        $is_ok = false;
                        $num = 0;
                        while(!$is_ok){
                            $num = rand($begin,$end);
                            $is_out = 1;
                            foreach ( $rand_array as $v) {
                                if ( $v == $num ) {
                                    $is_ok = false;
                                    $is_out = 0;
                                    break;
                                }
                            }
                            if ($is_out == 1) {
                                $is_ok = true;
                            }
                        }
                        $rand_array[] = $num;
                }
       return $rand_array;
}