<?php

session_start();
include_once 'header.php';
include_once 'dbcon.php';

echo "<meta charset='utf-8'>";

mysqli_autocommit($db_conx, FALSE);

$research_id = $_SESSION['research_id'];
echo "<br/><a href='ranking_final.php' style='float:right; margin-right:50px;' class='button icon arrowright'>Next</a><br/><br/>";

$select_users = "SELECT * from research_user where r_id = $research_id";
$result_users = mysqli_query($db_conx, $select_users);
$num_of_users = mysqli_num_rows($result_users);



$sql_quest = "SELECT * from quest where r_id =$research_id order by quest_id ASC";
$result_quest = mysqli_query($db_conx, $sql_quest);
while ($row_quest = mysqli_fetch_array($result_quest)) {


    if ($row_quest['sub'] == 0 || $row_quest['sub'] == 1) {
        $avg_weights = '';
        $sql_criteria = "SELECT * from quest_criteria where q_id={$row_quest['quest_id']}";
        $result_criteria = mysqli_query($db_conx, $sql_criteria);
        $num_of_weights = mysqli_num_rows($result_criteria);
        echo $num_of_weights;

        $sql_weights = "SELECT * from weights where q_id = {$row_quest['quest_id']}";
        for ($i = 0; $i < $num_of_weights; $i++) {
            $sum = 0;
            $result_weights = mysqli_query($db_conx, $sql_weights);
            while ($row_weights = mysqli_fetch_array($result_weights)) {
                $weights = explode("|", $row_weights['weight']);
                $sum = $sum + $weights[($i + 1)];
            }
            $avg = $sum / $num_of_users;
            $avg_weights .="|" . $avg;
        }
        $insert = "INSERT INTO avg_weight VALUES({$row_quest['quest_id']},$research_id,'$avg_weights')";
        try {
            mysqli_query($db_conx, $insert);
        } catch (Exception $ex) {
            
        }

        echo $avg_weights . "<br/>";
    } else if ($row_quest['sub'] == 2) {
        echo '<br/>Technologies<br/>';
        $sql_technology = "SELECT * from quest_alternatives where q_id={$row_quest['quest_id']}";
        $result_technology = mysqli_query($db_conx, $sql_technology);
        $num_of_weights = mysqli_num_rows($result_technology);
        echo $num_of_weights;

        $sql_factors = "SELECT * from sub_criteria where r_id=$research_id";
        $result_factors = mysqli_query($db_conx, $sql_factors);
        while ($row_factors = mysqli_fetch_array($result_factors)) {
            $avg_weights = '';
            $sql_weights = "SELECT * from weights_technology where f_id = {$row_factors['sub_criteria_id']}";
            for ($i = 0; $i < $num_of_weights; $i++) {
                $sum = 0;
                $result_weights = mysqli_query($db_conx, $sql_weights);
                while ($row_weights = mysqli_fetch_array($result_weights)) {
                    $weights = explode("|", $row_weights['weight']);
                    $sum = $sum + $weights[($i + 1)];
                }
                $avg = $sum / $num_of_users;
                $avg_weights .="|" . $avg;
            }
            
            $insert = "INSERT INTO avg_weight_technology VALUES({$row_quest['quest_id']},$research_id,{$row_factors['sub_criteria_id']},'$avg_weights')";
            try {
                mysqli_query($db_conx, $insert);
            } catch (Exception $ex) {
                
            }
            echo $avg_weights . "<br/>";
        }
    }
}




mysqli_commit($db_conx);
mysqli_close($db_conx);

header('Location: ranking_final.php');

include_once 'footer.php';
?>