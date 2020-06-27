<?php

include_once "../../dbcon.php";
session_start();
mysqli_autocommit($db_conx, FALSE);
$research_id = $_SESSION['research_id'];

$check = "SELECT * from technology where r_id=$research_id";
$result1 = mysqli_query($db_conx, $check);

if (mysqli_num_rows($result1) > 0) {
    $message = "You have already inserted technologies for this research";
    echo "<script type='text/javascript'>alert('$message'); window.location = 'create_research.php';</script>";
} else {
    $count = 1;
    while (isset($_POST['textbox' . $count])) {

        if ($_POST['textbox' . $count] == '') {
            echo "<meta charset='utf-8'>";
            $message = "Enter name for Technology #$count";
            echo "<script type='text/javascript'>alert('$message'); history.go(-1);</script>";
            return false;
            echo "<script>e.preventDefault(); history.go(-1);</script>";
        }

        if ($_POST['description' . $count] == '') {
            echo "<meta charset='utf-8'>";
            $message = "Enter description for Technology #$count";
            echo "<script type='text/javascript'>alert('$message'); history.go(-1);</script>";
            return false;
            echo "<script>e.preventDefault();</script>";
        }

        $sql = "INSERT INTO technology VALUES (0,$research_id,'" . $_POST['textbox' . $count] . "','" . $_POST['description' . $count] . "')";
        $result = mysqli_query($db_conx, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($db_conx), E_USER_ERROR);

        $count++;
    }

    $date2 = date('Y/m/d H:i:s', strtotime('+1 hours'));
    $description1 = "Please rate the alternatives, one compared to the other";


    $sql1 = "INSERT into quest VALUES (0,$research_id,'Pairwise Comparison of Alternatives','$date2','$description1',null,1,2,0)";
    $result = mysqli_query($db_conx, $sql1) or trigger_error("Query Failed! SQL: $sql1 - Error: ".mysqli_error($db_conx), E_USER_ERROR);


    $quest_id = mysqli_insert_id($db_conx);

    $query2 = "SELECT * FROM technology where r_id=$research_id";
    $result = mysqli_query($db_conx, $query2);
    while ($row = mysqli_fetch_array($result)) {
        $sql2 = "INSERT INTO quest_criteria VALUES ( $quest_id," . $row['t_id'] . ",$research_id, 2)";
        $result = mysqli_query($db_conx, $sql2) or trigger_error("Query Failed! SQL: $sql2 - Error: ".mysqli_error($db_conx), E_USER_ERROR);

    }

    $query3 = "SELECT * FROM technology where r_id=$research_id";
    $result = mysqli_query($db_conx, $query3);
    while ($row = mysqli_fetch_array($result)) {
        $sql3 = "INSERT INTO quest_alternatives VALUES ( $quest_id," . $row['t_id'] . ",$research_id)";
        $result = mysqli_query($db_conx, $sql3) or trigger_error("Query Failed! SQL: $sql3 - Error: ".mysqli_error($db_conx), E_USER_ERROR);

    }

    mysqli_commit($db_conx);
    mysqli_close($db_conx);
    echo "<meta charset='utf-8'>";
    $message = "Technologies created!";
    echo "<script type='text/javascript'>alert('$message'); window.location = 'main.php'</script>";
}
?>
