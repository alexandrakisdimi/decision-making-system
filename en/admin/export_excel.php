<?php

include_once "header.php";
date_default_timezone_set('Europe/Athens');


include 'Classes/PHPExcel.php';
include 'Classes/PHPExcel/Writer/Excel2007.php';
session_start();

$research_id = $_SESSION['research_id'];
include_once '../../dbcon.php';

echo "<h5>". date('H:i:s') . " Create new PHPExcel object</h5>";
$objPHPExcel = new PHPExcel();

PHPExcel_Shared_Font::setAutoSizeMethod(PHPExcel_Shared_Font::AUTOSIZE_METHOD_EXACT);

$sqlName = "Select * from research where research_id = $research_id";
$resultName = mysqli_query($db_conx, $sqlName);
while ($rowName = mysqli_fetch_array($resultName)) {
    $research_name = $rowName['rname'];
    $name = explode(" ", $research_name);
    $num_of_words = count($name);
}
$research_name = "";

for ($i = 0; $i < $num_of_words; $i++) {
    $research_name .= $name[$i] . '_';
}

$research_name .='Results';

// Set properties
echo "<h5>". date('H:i:s') . " Set properties</h5>";
$objPHPExcel->getProperties()->setCreator("Decision Maker");
$objPHPExcel->getProperties()->setLastModifiedBy("Decision Maker");
$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");


echo "<h5>". date('H:i:s') . " Create Final ranking </h5>";

$objPHPExcel->setActiveSheetIndex(0);

$alphas = range('A', 'Z');

echo "<h5>". date('H:i:s') . " Print ranking </h5>";
//print ranking

$count = 2;
$objPHPExcel->getActiveSheet()->SetCellValue("A1", 'Alternatives Ranking');
$objPHPExcel->getActiveSheet()->mergeCells("A1:B1");
$objPHPExcel->getActiveSheet()->SetCellValue("A$count", 'Name');
$objPHPExcel->getActiveSheet()->SetCellValue("B$count", 'Ranking');
$sql = "SELECT * from technology where r_id =$research_id order by t_id ASC";
$result = mysqli_query($db_conx, $sql);
while ($rowName = mysqli_fetch_array($result)) {
    $count++;
    $sqlFinalRanking = "SELECT * from ranking_final where r_id =$research_id and t_id={$rowName['t_id']}";
    $resultFinalRanking = mysqli_query($db_conx, $sqlFinalRanking);
    while ($rowFinalRanking = mysqli_fetch_array($resultFinalRanking)) {
        $objPHPExcel->getActiveSheet()->SetCellValue("A$count", $rowName['t_name']);
        $objPHPExcel->getActiveSheet()->SetCellValue("B$count", $rowFinalRanking['ranking']);
    }
}



echo "<h5>". date('H:i:s') . " Print avg weights of criteria </h5>";
//print avg weights of criteria
$count = 2;
$objPHPExcel->getActiveSheet()->SetCellValue("D1", 'Average Weights of Criteria');
$objPHPExcel->getActiveSheet()->mergeCells("D1:E1");
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
            $objPHPExcel->getActiveSheet()->SetCellValue("E$count", $weightsTechnology[($count - 2)]);
        }
    }
}


echo "<h5>". date('H:i:s') . " Print avg weights of factors </h5>";
//print avg weights of factors
$count = 2;
$objPHPExcel->getActiveSheet()->SetCellValue("G1", 'Average Weights of Factors');
$objPHPExcel->getActiveSheet()->mergeCells("G1:I1");
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

echo "<h5>". date('H:i:s') . " Print avg weights of technology </h5>";
//print avg weights of technology
$count = 2;
$objPHPExcel->getActiveSheet()->SetCellValue("K1", 'Average Weights of Alternatives per Factor');
$objPHPExcel->getActiveSheet()->mergeCells("K1:N1");
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



echo "<h5>". date('H:i:s') . " Print avg weights of technology Per User </h5>";
//print weights of technology per user

$countSheet = 1;


$sqlResearchUser = "Select * from research_user where r_id = $research_id";
$resultResearchUser = mysqli_query($db_conx, $sqlResearchUser);
while ($rowResearchUser = mysqli_fetch_array($resultResearchUser)) {
    $countGeneral = 1;
    $sqlUser = "Select * from users where user_id = {$rowResearchUser['u_id']}";
    $resultUser = mysqli_query($db_conx, $sqlUser);
    while ($rowUser = mysqli_fetch_array($resultUser)) {
        $objPHPExcel->createSheet();
        $objPHPExcel->setActiveSheetIndex($countSheet);

        echo "<h5>". date('H:i:s') . " Print ranking for user {$rowUser['user_id']} </h5>";

        $count = 2;
        $objPHPExcel->getActiveSheet()->SetCellValue("A1", 'Alternatives Ranking');
        $objPHPExcel->getActiveSheet()->mergeCells("A1:B1");
        $objPHPExcel->getActiveSheet()->SetCellValue("A$count", 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue("B$count", 'Ranking');
        $sql = "SELECT * from technology where r_id =$research_id order by t_id ASC";
        $result = mysqli_query($db_conx, $sql);
        while ($row = mysqli_fetch_array($result)) {
            $count++;
            $countGeneral++;
            $sqlRanking = "SELECT * from ranking where r_id =$research_id and t_id={$row['t_id']} and u_id={$rowUser['user_id']}";
            $resultRanking = mysqli_query($db_conx, $sqlRanking);
            while ($rowRanking = mysqli_fetch_array($resultRanking)) {
                $objPHPExcel->getActiveSheet()->SetCellValue("A$count", $row['t_name']);
                $objPHPExcel->getActiveSheet()->SetCellValue("B$count", $rowRanking['ranking']);
            }
        }



        echo "<h5>". date('H:i:s') . " Print avg weights of criteria for user_id={$rowUser['user_id']} </h5>";
//print weights of criteria
        $count = 2;
        $objPHPExcel->getActiveSheet()->SetCellValue("D1", 'Weights of Criteria');
        $objPHPExcel->getActiveSheet()->mergeCells("D1:E1");
        $objPHPExcel->getActiveSheet()->SetCellValue("D$count", 'Criterion');
        $objPHPExcel->getActiveSheet()->SetCellValue("E$count", 'Weight');
        $sqlQuestCriteria = "SELECT * from quest_criteria where r_id =$research_id and sub = 0 order by q_id, c_id ASC";
        $resultQuestCriteria = mysqli_query($db_conx, $sqlQuestCriteria);
        while ($rowQuestCriteria = mysqli_fetch_array($resultQuestCriteria)) {
            $count++;
            $sqlCriteria = "SELECT * from criteria where criterion_id = {$rowQuestCriteria['c_id']}";
            $resultCriteria = mysqli_query($db_conx, $sqlCriteria);
            if ($rowCriteria = mysqli_fetch_array($resultCriteria)) {
                $sqlAvgWeight = "SELECT * from weights where q_id = {$rowQuestCriteria['q_id']} and u_id ={$rowUser['user_id']} ";
                $resultAvgWeight = mysqli_query($db_conx, $sqlAvgWeight);
                if ($rowAvgWeight = mysqli_fetch_array($resultAvgWeight)) {
                    $objPHPExcel->getActiveSheet()->SetCellValue("D$count", $rowCriteria['c_name']);
                    $weightsTechnology = explode("|", $rowAvgWeight['weight']);
                    $objPHPExcel->getActiveSheet()->SetCellValue("E$count", $weightsTechnology[($count - 2)]);
                }
            }
        }



        echo "<h5>". date('H:i:s') . " Print avg weights of factors for user_id={$rowUser['user_id']} </h5>";
//print weights of factors
        $count = 2;
        $objPHPExcel->getActiveSheet()->SetCellValue("O1", 'Weights of Factors');
        $objPHPExcel->getActiveSheet()->mergeCells("O1:Q1");
        $objPHPExcel->getActiveSheet()->SetCellValue("O$count", 'Criterion');
        $objPHPExcel->getActiveSheet()->SetCellValue("P$count", 'Factor');
        $objPHPExcel->getActiveSheet()->SetCellValue("Q$count", 'Weight');
        $sqlCriteria = "Select * from criteria where r_id = $research_id order by criterion_id ASC";
        $resultCriteria = mysqli_query($db_conx, $sqlCriteria);
        while ($rowCriteria = mysqli_fetch_array($resultCriteria)) {
            $sqlFactor = "Select * from sub_criteria where c_id ={$rowCriteria['criterion_id']} order by sub_criteria_id ASC";
            $resultFactor = mysqli_query($db_conx, $sqlFactor);
            $num_weight = 1;
            while ($rowFactor = mysqli_fetch_array($resultFactor)) {
                $count++;

                $objPHPExcel->getActiveSheet()->SetCellValue("O$count", $rowCriteria['c_name']);
                $objPHPExcel->getActiveSheet()->SetCellValue("P$count", $rowFactor['sub_cr_name']);

                $sqlQuest = "Select * from quest_criteria where c_id = {$rowFactor['sub_criteria_id']} and sub = 1 order by q_id ASC";
                $resultQuest = mysqli_query($db_conx, $sqlQuest);
                if ($rowQuest = mysqli_fetch_array($resultQuest)) {
                    $sqlWeights = "Select * from weights where q_id = {$rowQuest['q_id']} and u_id={$rowUser['user_id']}";
                    $resultWeights = mysqli_query($db_conx, $sqlWeights);
                    if ($rowWeights = mysqli_fetch_array($resultWeights)) {
                        $weights = explode("|", $rowWeights['weight']);
                        $objPHPExcel->getActiveSheet()->SetCellValue("Q$count", $weights[$num_weight]);
                    }
                }
                $num_weight++;
            }
        }



        echo "<h5>". date('H:i:s') . " Print avg weights of technology for user_id={$rowUser['user_id']} </h5>";
//print avg weights of technology
        $count = 2;
        $objPHPExcel->getActiveSheet()->SetCellValue("S1", 'Weights of Alternatives per Factor');
        $objPHPExcel->getActiveSheet()->mergeCells("S1:V1");
        $objPHPExcel->getActiveSheet()->SetCellValue("S$count", 'Criterion');
        $objPHPExcel->getActiveSheet()->SetCellValue("T$count", 'Factor');
        $objPHPExcel->getActiveSheet()->SetCellValue("U$count", 'Technology');
        $objPHPExcel->getActiveSheet()->SetCellValue("V$count", 'Weight');

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
                        $sqlWeights = "Select * from weights_technology where q_id = {$rowQuest['q_id']} and f_id = {$rowFactor['sub_criteria_id']} and u_id = {$rowUser['user_id']}";
                        $resultWeights = mysqli_query($db_conx, $sqlWeights);
                        if ($rowWeights = mysqli_fetch_array($resultWeights)) {
                            $weights = explode("|", $rowWeights['weight']);
                            $objPHPExcel->getActiveSheet()->SetCellValue("S$count", $rowCriteria['c_name']);
                            $objPHPExcel->getActiveSheet()->SetCellValue("T$count", $rowFactor['sub_cr_name']);
                            $objPHPExcel->getActiveSheet()->SetCellValue("U$count", $rowTechnology['t_name']);
                            $objPHPExcel->getActiveSheet()->SetCellValue("V$count", $weights[$num_weight]);
                        }
                    }
                    $num_weight++;
                }
            }
        }

        echo "<h5>". date('H:i:s') . " Print criteria for user_id={$rowUser['user_id']}</h5>";
        $sqlQuest = "SELECT * from quest where r_id=$research_id ORDER BY quest_id ASC";
        $resultQuest = mysqli_query($db_conx, $sqlQuest);

        $countGeneral = $countGeneral + 10;
        while ($rowQuest = mysqli_fetch_array($resultQuest)) {
            $countGeneral = $countGeneral + 2;
            if ($rowQuest['type'] == 1) {
                $queryQuestCriteria = "SELECT * FROM quest_criteria where q_id='" . $rowQuest['quest_id'] . "' ORDER BY c_id ASC";
                $resultQuestCriteria = mysqli_query($db_conx, $queryQuestCriteria);
                $count = 0;
                $array = array();
                $array_desc = array();
                $array_id = array();
                $array_t_c_id = array();
                $array_t_c_name = array();
                if ($row2 = mysqli_fetch_array($resultQuestCriteria)) {
                    if ($rowQuest['sub'] == 0) {
                        $query3 = "SELECT * from criteria where r_id=$research_id order by criterion_id ASC";
                        $result3 = mysqli_query($db_conx, $query3);
                        while ($row3 = mysqli_fetch_array($result3)) {
                            array_push($array, $row3['c_name']);
                            array_push($array_id, $row3['criterion_id']);
                            array_push($array_desc, $row3['c_description']);
                        }
                    } else if ($rowQuest['sub'] == 1) {
                        $query3 = "SELECT * from sub_criteria where c_id = (SELECT criterion_id from criteria where criterion_id= (SELECT c_id from quest where quest_id=" . $rowQuest['quest_id'] . ")) order by sub_criteria_id";
                        $result3 = mysqli_query($db_conx, $query3);
                        while ($row3 = mysqli_fetch_array($result3)) {
                            array_push($array, $row3['sub_cr_name']);
                            array_push($array_id, $row3['sub_criteria_id']);
                            array_push($array_desc, $row3['sub_cr_description']);
                        }
                    } else if ($rowQuest['sub'] == 2) {
                        $query3 = "SELECT * from sub_criteria where r_id=$research_id order by sub_criteria_id ASC";
                        $result3 = mysqli_query($db_conx, $query3);
                        while ($row3 = mysqli_fetch_array($result3)) {
                            array_push($array_t_c_id, $row3['sub_criteria_id']);
                            array_push($array_t_c_name, $row3['sub_cr_name']);
                        }
                        $query4 = "SELECT * from technology where r_id=$research_id order by t_id ASC";
                        $result4 = mysqli_query($db_conx, $query4);
                        while ($row4 = mysqli_fetch_array($result4)) {
                            array_push($array, $row4['t_name']);
                            array_push($array_id, $row4['t_id']);
                            array_push($array_desc, $row4['t_description']);
                            
                        }
                    }
                    $num_rows = count($array);
                    $t_counter = count($array_t_c_id);
                    if ($rowQuest['sub'] == 2) {
                        for ($k = 0; $k < $t_counter; $k++) {

                            $objPHPExcel->getActiveSheet()->SetCellValue($alphas[0] . '' . $countGeneral, $array_t_c_name[$k]);
                            $countGeneral++;

                            for ($i = 0; $i < $num_rows; $i++) {
                                $objPHPExcel->getActiveSheet()->SetCellValue($alphas[$i + 1] . '' . $countGeneral, $array[$i]);
                            }
                            for ($i = 0; $i < $num_rows; $i++) {
                                $countGeneral++;
                                $objPHPExcel->getActiveSheet()->SetCellValue($alphas[0] . '' . $countGeneral, $array[$i]);
                                for ($j = 0; $j < $num_rows; $j++) {
                                    $sql_technology_answers = "select * from technology_answers where q_id={$rowQuest['quest_id']} and u_id={$rowUser['user_id']} and r_id={$research_id} and t1_id={$array_id[$i]} and t2_id={$array_id[$j]} and f_id={$array_t_c_id[$k]}";
                                    $result_technology_answers = mysqli_query($db_conx, $sql_technology_answers);
                                    if ($row_technology_answers = mysqli_fetch_array($result_technology_answers)) {
                                        $objPHPExcel->getActiveSheet()->SetCellValue($alphas[$j + 1] . '' . $countGeneral, $row_technology_answers['value']);
                                    }
                                }
                            }
                            $countGeneral++;
                            $sqlEigenvalues = "select * from eigenvalues_technology where q_id={$rowQuest['quest_id']} and u_id={$rowUser['user_id']} and r_id={$research_id} and f_id={$array_t_c_id[$k]}";
                            $resultEigenvalues = mysqli_query($db_conx, $sqlEigenvalues);
                            if ($rowEigenvalues = mysqli_fetch_array($resultEigenvalues)) {
                                $objPHPExcel->getActiveSheet()->SetCellValue($alphas[0] . '' . $countGeneral, 'CR');
                                $objPHPExcel->getActiveSheet()->SetCellValue($alphas[1] . '' . $countGeneral, $rowEigenvalues['cr']);
                            }
                            $countGeneral = $countGeneral + 3;
                        }
                    } else {
                        for ($i = 0; $i < $num_rows; $i++) {
                            $objPHPExcel->getActiveSheet()->SetCellValue($alphas[$i + 1] . '' . $countGeneral, $array[$i]);
                        }
                        for ($i = 0; $i < $num_rows; $i++) {
                            $countGeneral++;
                            $objPHPExcel->getActiveSheet()->SetCellValue($alphas[0] . '' . $countGeneral, $array[$i]);
                            for ($j = 0; $j < $num_rows; $j++) {
                                $sql = "select * from answers where q_id={$rowQuest['quest_id']} and u_id={$rowUser['user_id']} and r_id={$research_id} and c_id1={$array_id[$i]} and c_id2={$array_id[$j]} ";
                                $result_answers = mysqli_query($db_conx, $sql);
                                if ($row_ansers = mysqli_fetch_array($result_answers)) {
                                    $objPHPExcel->getActiveSheet()->SetCellValue($alphas[$j + 1] . '' . $countGeneral, $row_ansers['value']);
                                }
                            }
                        }
                        $countGeneral++;
                        $sqlEigenvalues = "select * from eigenvalues where q_id={$rowQuest['quest_id']} and u_id={$rowUser['user_id']} and r_id={$research_id} ";
                        $resultEigenvalues = mysqli_query($db_conx, $sqlEigenvalues);
                        if ($rowEigenvalues = mysqli_fetch_array($resultEigenvalues)) {
                            $objPHPExcel->getActiveSheet()->SetCellValue($alphas[0] . '' . $countGeneral, 'CR');
                            $objPHPExcel->getActiveSheet()->SetCellValue($alphas[1] . '' . $countGeneral, $rowEigenvalues['cr']);
                        }
                        $countGeneral = $countGeneral + 2;
                    }
                }
            }
        }

        $objPHPExcel->getActiveSheet()->setTitle($rowUser['fname'] . ' ' . $rowUser['lname']);
        $countSheet++;
    }
}


echo "<br />";
echo "<h5>". date('H:i:s') . " Write to Excel2007 format</h5>";

$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save("$research_name.xlsx");


echo "<h5>". date('H:i:s') . " Done writing file. 
It can be downloaded by <a href='$research_name.xlsx' style='color:green;'>clicking here</a></h5>";


include_once "footer.php";
?>
