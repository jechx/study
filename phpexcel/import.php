<?php
header('Content-type:text/html;charset=utf-8');

require './phpexcel/PHPExcel.php';


$file = './export.xls';


/*
 * 全部加载
 */
$excel = PHPExcel_IOFactory::load($file);
$sheet = $excel->getSheet(0);//获取索引为0的sheet表

//case  ： 一次性读取sheet的所有数据，并转换成数组
$data = $sheet->toArray();


//case : 逐行读取
foreach($sheet->getRowIterator() as $row){
	
	foreach($row->getCellIterator() as $cell){
		echo $cell;
	}
}

//选择加载，参考文档



