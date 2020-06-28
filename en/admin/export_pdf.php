<?php

date_default_timezone_set('Europe/Athens');


include 'Classes/PHPExcel.php';
include 'Classes/PHPExcel/Writer/Excel2007.php';
include 'Classes/PHPExcel/IOFactory.php';
session_start();
include_once 'dbcon.php';

echo date('H:i:s') . " Create new PHPExcel object<br />";
$objPHPExcel = new PHPExcel();

PHPExcel_Shared_Font::setAutoSizeMethod(PHPExcel_Shared_Font::AUTOSIZE_METHOD_EXACT);

// Set properties
echo date('H:i:s') . " Set properties<br />";
$objPHPExcel->getProperties()->setCreator("Decision Maker");
$objPHPExcel->getProperties()->setLastModifiedBy("Decision Maker");
$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");


echo date('H:i:s') . " Create Final ranking <br />";

$objPHPExcel->setActiveSheetIndex(0);

$alphas = range('A', 'Z');
$research_id = $_SESSION['research_id'];

echo date('H:i:s') . " Print ranking <br />";
//print ranking

$count = 1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$count", 'Technology');
$objPHPExcel->getActiveSheet()->SetCellValue("B$count", 'Ranking');
$sql = "SELECT * from technology where r_id =$research_id order by t_id ASC";
$result = mysqli_query($db_conx, $sql);
while ($row = mysqli_fetch_array($result)) {
    $count++;
    $sqlFinalRanking = "SELECT * from ranking_final where r_id =$research_id and t_id={$row['t_id']}";
    $resultFinalRanking = mysqli_query($db_conx, $sqlFinalRanking);
    while ($rowFinalRanking = mysqli_fetch_array($resultFinalRanking)) {
        $objPHPExcel->getActiveSheet()->SetCellValue("A$count", $row['t_name']);
        $objPHPExcel->getActiveSheet()->SetCellValue("B$count", $rowFinalRanking['ranking']);
    }
}

echo date('H:i:s') . " Print avg weights of criteria <br />";
//print avg weights of criteria
$count = 1;
$objPHPExcel->getActiveSheet()->SetCellValue("D$count", 'Criterion');
$objPHPExcel->getActiveSheet()->SetCellValue("E$count", 'Average Weight');
$sqlQuestCriteria = "SELECT * from quest_criteria where r_id =$research_id and sub = 0 order by q_id, c_id ASC";
$resultQuestCriteria = mysqli_query($db_conx, $sqlQuestCriteria);
while ($rowQuestCriteria = mysqli_fetch_array($resultQuestCriteria)) {
    $count++;
    $sqlCriteria = "SELECT * from criteria where criterion_id = {$rowQuestCriteria['c_id']}";
    $resultCriteria = mysqli_query($db_conx, $sqlCriteria);
    if ($rowCriteria = mysqli_fetch_array($resultCriteria)) {
        $sqlAvgWeight = "SELECT * from avg_weight where q_id = {$rowQuestCriteria['q_id']}";
        $resultAvgWeight = mysqli_query($db_conx, $sqlAvgWeight);
        if ($rowAvgWeight = mysqli_fetch_array($resultAvgWeight)) {
            $objPHPExcel->getActiveSheet()->SetCellValue("D$count", $rowCriteria['c_name']);
            $weightsTechnology = explode("|", $rowAvgWeight['weight']);
            $objPHPExcel->getActiveSheet()->SetCellValue("E$count", $weightsTechnology[($count - 1)]);
        }
    }
}


echo date('H:i:s') . " Print avg weights of factors <br />";
//print avg weights of factors
$count = 1;
$objPHPExcel->getActiveSheet()->SetCellValue("G$count", 'Criterion');
$objPHPExcel->getActiveSheet()->SetCellValue("H$count", 'Factor');
$objPHPExcel->getActiveSheet()->SetCellValue("I$count", 'Average Weight');
$sqlCriteria = "Select * from criteria where r_id = $research_id order by criterion_id ASC";
$resultCriteria = mysqli_query($db_conx, $sqlCriteria);
while ($rowCriteria = mysqli_fetch_array($resultCriteria)) {
    $sqlFactor = "Select * from sub_criteria where c_id ={$rowCriteria['criterion_id']} order by sub_criteria_id ASC";
    $resultFactor = mysqli_query($db_conx, $sqlFactor);
    $num_weight = 1;
    while ($rowFactor = mysqli_fetch_array($resultFactor)) {
        $count++;

        $objPHPExcel->getActiveSheet()->SetCellValue("G$count", $rowCriteria['c_name']);
        $objPHPExcel->getActiveSheet()->SetCellValue("H$count", $rowFactor['sub_cr_name']);

        $sqlQuest = "Select * from quest_criteria where c_id = {$rowFactor['sub_criteria_id']} and sub = 1 order by q_id ASC";
        $resultQuest = mysqli_query($db_conx, $sqlQuest);
        if ($rowQuest = mysqli_fetch_array($resultQuest)) {
            $sqlWeights = "Select * from avg_weight where q_id = {$rowQuest['q_id']}";
            $resultWeights = mysqli_query($db_conx, $sqlWeights);
            if ($rowWeights = mysqli_fetch_array($resultWeights)) {
                $weights = explode("|", $rowWeights['weight']);
                $objPHPExcel->getActiveSheet()->SetCellValue("I$count", $weights[$num_weight]);
            }
        }
        $num_weight++;
    }
}
$objPHPExcel->getActiveSheet()->setTitle('Final Ranking');

echo date('H:i:s') . " Print avg weights of technology <br />";
//print avg weights of technology
$count = 1;
$objPHPExcel->getActiveSheet()->SetCellValue("K$count", 'Criterion');
$objPHPExcel->getActiveSheet()->SetCellValue("L$count", 'Factor');
$objPHPExcel->getActiveSheet()->SetCellValue("M$count", 'Technology');
$objPHPExcel->getActiveSheet()->SetCellValue("N$count", 'Average Weight');

$sqlCriteria = "Select * from criteria where r_id = $research_id order by criterion_id ASC";
$resultCriteria = mysqli_query($db_conx, $sqlCriteria);
while ($rowCriteria = mysqli_fetch_array($resultCriteria)) {
    $sqlFactor = "Select * from sub_criteria where c_id ={$rowCriteria['criterion_id']} order by sub_criteria_id ASC";
    $resultFactor = mysqli_query($db_conx, $sqlFactor);
    while ($rowFactor = mysqli_fetch_array($resultFactor)) {
        $num_weight = 1;
        $sqlTechnology = "Select * from technology where r_id = $research_id";
        $resultTechnology = mysqli_query($db_conx, $sqlTechnology);
        while ($rowTechnology = mysqli_fetch_array($resultTechnology)) {
            $count++;
            $sqlQuest = "Select * from quest_alternatives where t_id1 = {$rowTechnology['t_id']}";
            $resultQuest = mysqli_query($db_conx, $sqlQuest);
            if ($rowQuest = mysqli_fetch_array($resultQuest)) {
                $sqlWeights = "Select * from avg_weight_technology where q_id = {$rowQuest['q_id']} and c_id = {$rowFactor['sub_criteria_id']}";
                $resultWeights = mysqli_query($db_conx, $sqlWeights);
                if ($rowWeights = mysqli_fetch_array($resultWeights)) {
                    $weights = explode("|", $rowWeights['weight']);
                    $objPHPExcel->getActiveSheet()->SetCellValue("K$count", $rowCriteria['c_name']);
                    $objPHPExcel->getActiveSheet()->SetCellValue("L$count", $rowFactor['sub_cr_name']);
                    $objPHPExcel->getActiveSheet()->SetCellValue("M$count", $rowTechnology['t_name']);
                    $objPHPExcel->getActiveSheet()->SetCellValue("N$count", $weights[$num_weight]);
                }
            }
            $num_weight++;
        }
    }
}
$objPHPExcel->getActiveSheet()->setTitle('Final Ranking');


echo "<br />";
echo date('H:i:s') . " Write to Excel2007 format<br />";

$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save("test.xlsx");


echo date('H:i:s') . " Done writing file. 
It can be downloaded by <a href='test.xlsx'>clicking here</a>";




$rendererName = PHPExcel_Settings::PDF_RENDERER_MPDF;
$rendererLibrary = 'mpdf.php';
$rendererLibraryPath = 'Classes/mpdf/' . $rendererLibrary;

if (!PHPExcel_Settings::setPdfRenderer(
                $rendererName, $rendererLibraryPath
        )) {
    die(
            'NOTICE: Please set the $rendererName and $rendererLibraryPath values' .
            '<br />' .
            'at the top of this script as appropriate for your directory structure'
    );
}
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment;filename="test.pdf"');
        header('Cache-Control: max-age=0');

$objPHPexcel = PHPExcel_IOFactory::load('test.pdf');
echo '1';
$objWriter2 = PHPExcel_IOFactory::createWriter($objPHPexcel, 'PDF');
echo '2';
$objWriter2->writeAllSheets();
echo '3';
$objWriter2->setPreCalculateFormulas(false);
echo '4';
$objWriter2->save('php://output');


?>