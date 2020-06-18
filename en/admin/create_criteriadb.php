<?php

include_once "../../dbcon.php";
session_start();
echo "<meta charset='utf-8'>";
mysqli_autocommit($db_conx, FALSE);

$count = 1;

$research_id = $_SESSION['research_id'];
$date2 = date('Y/m/d H:i:s', strtotime('+1 hours'));
$description1 = "Please rate the criteria, one compared to the other";

while (isset($_POST['textbox' . $count])) {

    if ($_POST['textbox' . $count] == '') {
        mysqli_commit($db_conx);
        mysqli_close($db_conx);
        $message = "Enter name for criteria #$count";
        echo "<script>alert('$message');</script>";
        echo "<script>history.go(-1);</script>";
        return false;
        echo "<script>e.preventDefault();</script>";
    }

    if ($_POST['description' . $count] == '') {
        mysqli_commit($db_conx);
        mysqli_close($db_conx);
        $message = "Enter description for criteria #$count";
        echo "<script>alert('$message');</script>";
        echo "<script>history.go(-1);</script>";
        return false;
        echo "<script>e.preventDefault();</script>";
    }

    $criteria_name =rtrim($_POST['textbox'.$count]);
    $criteria_description =rtrim($_POST['description'.$count]);

    $sql = "INSERT INTO criteria VALUES (0,$research_id,'$critera_name','$criteria_description',0)";
    $result = mysqli_query($db_conx, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($db_conx), E_USER_ERROR);

    $count++;
}



$select = "SELECT * from quest where type=1 and r_id=$research_id and sub=0";
$results = mysqli_query($db_conx, $select);
if (mysqli_num_rows($results) == 0) {
    $query1 = "INSERT INTO quest VALUES (0,$research_id, 'Pairwise Comparison of Criteria', '$date2','$description1',null,1,0,0)";
    $result = mysqli_query($db_conx, $query1) or trigger_error("Query Failed! SQL: $query1 - Error: ".mysqli_error($db_conx), E_USER_ERROR);

} else if (mysqli_num_rows($results) > 0) {
    echo "<meta charset='utf-8'>";
    $message1 = "You can't add more criteria to this research! Please delete and start over.";
    echo "<script type='text/javascript'>alert('$message1'); window.location = 'main.php';</script>";
    die('Error: 2 ' . mysqli_error($db_conx));
}

$quest_id = mysqli_insert_id($db_conx);

$query2 = "SELECT * FROM criteria where r_id=$research_id";
$result = mysqli_query($db_conx, $query2);
while ($row = mysqli_fetch_array($result)) {
    $sql1 = "INSERT INTO quest_criteria VALUES ( $quest_id," . $row['criterion_id'] . ",$research_id, 0)";
    $result = mysqli_query($db_conx, $sql1) or trigger_error("Query Failed! SQL: $sql1 - Error: ".mysqli_error($db_conx), E_USER_ERROR);
}

$sql = "SELECT * from quest_criteria where q_id=$quest_id order by c_id ASC";
$sql2 = "SELECT * from quest_criteria where q_id=$quest_id order by c_id ASC";
$result1 = mysqli_query($db_conx, $sql);

while ($row1 = mysqli_fetch_array($result1)) {
    $result2 = mysqli_query($db_conx, $sql2);
    while ($row2 = mysqli_fetch_array($result2)) {
        if ($row1['c_id'] != $row2['c_id']) {
            $sql3 = "SELECT * from quest1 where c1_id=" . $row1['c_id'] . " and c2_id=" . $row2['c_id'] . " and q_id=$quest_id";
            $result3 = mysqli_query($db_conx, $sql3);
            if (mysqli_num_rows($result3) == 0) {
                $sql4 = "SELECT * from quest1 where c1_id=" . $row2['c_id'] . " and c2_id=" . $row1['c_id'] . " and q_id=$quest_id";
                $result4 = mysqli_query($db_conx, $sql4);
                if (mysqli_num_rows($result4) == 0) {
                    $sql5 = "INSERT into quest1 values ($quest_id," . $row1['c_id'] . "," . $row2['c_id'] . ",$research_id,'','',0);";
                    $result = mysqli_query($db_conx, $sql5) or trigger_error("Query Failed! SQL: $sql5 - Error: ".mysqli_error($db_conx), E_USER_ERROR);
                }
            }
        }
    }
}

mysqli_commit($db_conx);
mysqli_close($db_conx);
echo "<meta charset='utf-8'>";
$message = "Data sent successfully.";
echo "<script type='text/javascript'>alert('$message'); window.location = 'create_factors.php';</script>";
?>

