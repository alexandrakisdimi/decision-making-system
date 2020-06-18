<?php

include_once "../../dbcon.php";
session_start();
mysqli_autocommit($db_conx, FALSE);
$research_id = $_SESSION['research_id'];
$c_id = $_SESSION['c_id'];

echo "<meta charset='utf-8'>";

//check if fields are filled in
$count = 1;
while (isset($_POST['textbox' . $count])) {

    if ($_POST['textbox' . $count] == '') {
        $message = "Enter name for factor #$count";
        echo "<script type='text/javascript'>alert('$message'); history.go(-1);</script>";
        return false;
        echo "<script>e.preventDefault();</script>";
    }

    if ($_POST['description' . $count] == '') {
        $message = "Enter description for factor #$count";
        echo "<script type='text/javascript'>alert('$message'); history.go(-1);</script>";
        return false;
        echo "<script>e.preventDefault();</script>";
    }

    $sql = "INSERT INTO sub_criteria VALUES (0,$c_id,'" . $_POST['textbox' . $count] . "',$research_id,'" . $_POST['description' . $count] . "')";
    if (!mysqli_query($db_conx, $sql)) {
        mysqli_rollback($db_conx);
        $_SESSION['error'] = 'all ok';
        $message = "Creating factors failed. Error: 1";
        echo "<script type='text/javascript'>alert('$message'); history.go(-1);</script>";
        die('Error: 1' . mysqli_error($db_conx));
    }
    $count++;

    $sql = "UPDATE criteria set sub_criteria=2 where criterion_id=$c_id";
    if (!mysqli_query($db_conx, $sql)) {
        mysqli_rollback($db_conx);
        $_SESSION['error'] = 'all ok';
        $message = "Updating criteria failed.Error: 2";
        echo "<script type='text/javascript'>alert('$message'); history.go(-1);</script>";
        die('Error: 2' . mysqli_error($db_conx));
    }
}

//insert into database
$date2 = date('Y/m/d H:i:s', strtotime('+1 hours'));
$description1 = "Please rate the factors, one compared to the other";

$entoli = "SELECT * from criteria where criterion_id=$c_id";
$apotelesma = mysqli_query($db_conx, $entoli);
$seira = mysqli_fetch_array($apotelesma);


$query1 = "INSERT INTO quest VALUES (0,$research_id, 'Factor Pairwise Comparison of " . $seira['c_name'] . "', '$date2','$description1',$c_id,1,1,0)";
if (!mysqli_query($db_conx, $query1)) {
    mysqli_rollback($db_conx);
    $_SESSION['error'] = 'all ok';
    $message = "Creating Pairwise Comparison of factors failed. Servers are down. Error: 1";
    echo "<script type='text/javascript'>alert('$message'); history.go(-1);</script>";
    die('Error: 2 ' . mysqli_error($db_conx));
}

$quest_id = mysqli_insert_id($db_conx);

$query2 = "SELECT * FROM sub_criteria where c_id=$c_id";
$result = mysqli_query($db_conx, $query2);
while ($row = mysqli_fetch_array($result)) {
    $sql1 = "INSERT INTO quest_criteria VALUES ( $quest_id," . $row['sub_criteria_id'] . ",$research_id, 1)";
    if (!mysqli_query($db_conx, $sql1)) {
        mysqli_rollback($db_conx);
        $_SESSION['error'] = 'all ok';
        $message = "Setting factors to questionnaire failed";
        echo "<script type='text/javascript'>alert('$message'); history.go(-1);</script>";
        die('Error: ' . mysqli_error($db_conx));
    }
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
                    $sql5 = "INSERT into quest1 values ($quest_id," . $row1['c_id'] . "," . $row2['c_id'] . ",$research_id,'','',1);";
                    if (!mysqli_query($db_conx, $sql5)) {
                        mysqli_rollback($db_conx);
                        $_SESSION['error'] = 'all ok';
                        $message = "Creating Pairwise Comparison of factors failed. Servers are down. Error: 2";
                        echo "<script type='text/javascript'>alert('$message'); history.go(-1);</script>";
                        die('Error: 2 ' . mysqli_error($db_conx));
                    }
                }
            }
        }
    }
}
mysqli_commit($db_conx);
mysqli_close($db_conx);
$message = "Data sent successfully.";
echo "<script type='text/javascript'>alert('$message'); window.location = 'create_factors.php';</script>";
?>