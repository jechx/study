<?php

require('D:\wamp\www/func.php');
error_reporting(E_ALL);

//p($_FILES);
$fileInfo = $_FILES['pic'];
$maxSize = 123456;

/**
 *
 */


if(move_uploaded_file($fileInfo['tmp_name'], $fileInfo['name'])){
    echo 'upload success';
}

/**
 * 检测文件扩展名是否正确
 */
function checkExt($fileInfo,$allowExt=array('jpg','jpeg','gif')){
    $ext = pathinfo($fileInfo['name'],PATHINFO_EXTENSION);
    if(! in_array($ext,$allowExt)){
        $msg = "文件扩展名不对";
    }
    return $msg;
}

/**
 * 检测文件上传错误
 * @param $fileInfo
 */
function checkError($fileInfo){
    if($fileInfo['error'] > 0){
        switch($fileInfo['error']){
            case 1:
                $msg = '文件大小超过限制upload_max_filesize';
                break;
            case 2:
                $msg = "文件大小超出限制max_file_size";
                break;
            case 3:
                $msg = "文件只有部分被上传";
                break;
            case 4:
                $msg = "没有文件上传";
                break;
            case 6:
                $msg = "找不到临时文件夹";
                break;
            case 7:
                $msg = "文件写入失败";
                break;
            case 8:
                $msg = "上传被PHP扩展中断";
                break;
        }
    }

    return $msg;
}

/**
 * 检查上传文件的大小是否超过限制
 * @param $fileInfo
 * @param $maxSize
 */
function checkSize($fileInfo,$maxSize){
    if($fileInfo['size'] > $maxSize){
        $msg  = 'the size of uploading is too big';
    }
    return $msg;
}