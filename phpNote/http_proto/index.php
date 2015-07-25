<?php
require './http.class.php';
header('Content-type:text/html;charset=utf-8');
/*
 * 反防盗链
 */

$url = 'http://168.192.8.35/a.jpg';
$sock = new Sock($url);

$sock->setHead('Referer:http://localhost');
$res = $sock->get();
file_put_contents('d.jpg',substr(strstr($res,"\r\n\r\n"),4));


/**
 *获取a.jpg,  并保存为c.jpg
 *
$url = 'http://localhost/a.jpg';
$sock = new Sock($url);
$res = $sock->get();

file_put_contents('c.jpg',substr(strstr($res,"\r\n\r\n"),4));
*/

//get 测试
//echo $sock->get();

/* post 测试
$url = 'http://news.163.com/15/0625/04/ASU94A9P0001124J.html';
$sock = new Sock($url);

$postContent = array(
	'title' => 'a',
	'content'=>'i am the test !'
);

echo $sock->post($postContent);
*/