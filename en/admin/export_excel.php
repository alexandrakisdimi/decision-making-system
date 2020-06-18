<?php

date_default_timezone_set('America/Los_Angeles');

include 'Classes/PHPExcel.php';

include 'Classes/PHPExcel/Writer/Excel2007.php';

echo date('H:i:s') . " Create new PHPExcel object<br />";
$objPHPExcel = new PHPExcel();

// Set properties
echo date('H:i:s') . " Set properties --- AAAA <br />";
$objPHPExcel->getProperties()->setCreator("Runnable.com");
$objPHPExcel->getProperties()->setLastModifiedBy("Runnable.com");
$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, 
generated using PHP classes.");


// Add some data
echo date('H:i:s') . " Add some data<br />";
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Hello');
$objPHPExcel->getActiveSheet()->SetCellValue('A2', 'world!');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Hello');
$objPHPExcel->getActiveSheet()->SetCellValue('C2', 'world!');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Hello');
$objPHPExcel->getActiveSheet()->SetCellValue('B2', 'world!');

// Rename sheet
echo date('H:i:s') . " Rename sheet<br />";
$objPHPExcel->getActiveSheet()->setTitle('Simple');

// Save Excel 2007 file
echo date('H:i:s') . " Write to Excel2007 format<br />";
/*
 * These lines are commented just for this demo purposes
 * This is how the excel file is written to the disk, 
 * but in this case we don't need them since the file was written at the first run
 */
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));

// Echo done
echo date('H:i:s') . " Done writing file. 
It can be downloaded by <a href='export_excel.xlsx'>clicking here</a>";
?>