<?php

session_start();
include_once 'header.php';
include_once "../../dbcon.php";

echo "<meta charset='utf-8'>";

mysqli_autocommit($db_conx, FALSE);

$research_id = $_SESSION['research_id'];
//$research_id = 107;

echo "<br/><a href='ranking_final.php' style='float:right; margin-right:50px;' class='button icon arrowright'>Next</a><br/><br/>";

$select_users = "SELECT * from research_user where r_id = $research_id";
$resultusers = mysqli_query($db_conx, $select_users);
$num_of_users = mysqli_num_rows($resultusers);

$sql_quest = "SELECT * from quest where r_id =$research_id order by quest_id ASC";
$resultquest = mysqli_query($db_conx, $sql_quest);
while ($row_quest = mysqli_fetch_array($resultquest)) {


    if ($row_quest['sub'] == 0 || $row_quest['sub'] == 1) {
        $avg_weights = '';
        $sql_criteria = "SELECT * from quest_criteria where q_id={$row_quest['quest_id']}";
        $resultcriteria = mysqli_query($db_conx, $sql_criteria);
        $num_of_weights = mysqli_num_rows($resultcriteria);
        echo $num_of_weights;

        $sql_weights = "SELECT * from weights where q_id = {$row_quest['quest_id']}";
        for ($i = 0; $i < $num_of_weights; $i++) {
            $sum = 0;
            $resultweights = mysqli_query($db_conx, $sql_weights);
            while ($row_weights = mysqli_fetch_array($resultweights)) {
                $weights = explode("|", $row_weights['weight']);
                $sum = $sum + $weights[($i + 1)];
            }
            $avg = $sum / $num_of_users;
            $avg_weights .="|" . $avg;
        }
        $insert = "INSERT INTO avg_weight VALUES({$row_quest['quest_id']},$research_id,'$avg_weights')";
        $resultinsert = mysqli_query($db_conx, $insert);

        echo $avg_weights . "<br/>";
    } else if ($row_quest['sub'] == 2) {
        echo '<br/>Technologies<br/>';
        $sql_technology = "SELECT * from quest_alternatives where q_id={$row_quest['quest_id']}";
        $resultechnology = mysqli_query($db_conx, $sql_technology);
        $num_of_weights = mysqli_num_rows($resultechnology);
        echo $num_of_weights;

        $sql_factors = "SELECT * from sub_criteria where r_id=$research_id";
        $resultfactors = mysqli_query($db_conx, $sql_factors);
        while ($row_factors = mysqli_fetch_array($resultfactors)) {
            $avg_weights = '';
            $sql_weights = "SELECT * from weights_technology where f_id = {$row_factors['sub_criteria_id']}";
            for ($i = 0; $i < $num_of_weights; $i++) {
                $sum = 0;
                $resultweights = mysqli_query($db_conx, $sql_weights);
                while ($row_weights = mysqli_fetch_array($resultweights)) {
                    $weights = explode("|", $row_weights['weight']);
                    $sum = $sum + $weights[($i + 1)];
                }
                $avg = $sum / $num_of_users;
                $avg_weights .="|" . $avg;
            }
            
            $insert = "INSERT INTO avg_weight_technology VALUES({$row_quest['quest_id']},$research_id,{$row_factors['sub_criteria_id']},'$avg_weights')";
            $resultinsert = mysqli_query($db_conx, $insert);
            echo $avg_weights . "<br/>";
        }
    }
}




mysqli_commit($db_conx);
mysqli_close($db_conx);

header('Location: ranking_final.php');

include_once 'footer.php';
?>