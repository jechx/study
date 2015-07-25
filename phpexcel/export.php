<?php

require './phpexcel/PHPExcel.php';


$excel = new PHPExcel;//实例化PHPExcel对象

$sheet = $excel->getActiveSheet();//实例化PHPExcel对象后，默认会创建一个sheet，可以用createSheet()创建新的sheet，setActiveSheetIndex()设置使用的sheet
$sheet->setTitle('example');//设置sheet标题
$sheet->setCellValue('A1','NO')->setCellValue('B1','姓名')->setCellValue('C1','性别');//填充数据

for($i = 2;$i<10;$i++){
	$sheet->setCellValue('A'.$i,$i)->setCellValue('B'.$i,'张'.$i)->setCellValue('C'.$i,'男');
}

$writer = PHPExcel_IOFactory::createWriter($excel,'Excel5');//生成excel文件，Excel5是Excel2003的文件按，还有Excel2007

$writer->save('./export.xls');//保存Excel文件

