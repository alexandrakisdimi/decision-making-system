<?php

include_once "../../dbcon.php";
session_start();
mysqli_autocommit($db_conx, FALSE);
$research_id = $_SESSION['research_id'];

$check = "SELECT * from technology where r_id=$research_id";
$result1 = mysqli_query($db_conx, $check);

if (mysqli_num_rows($result1) > 0) {
    echo "<meta charset='utf-8'>";
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
        if (!mysqli_query($db_conx, $sql)) {
            mysqli_rollback($db_conx);
            $_SESSION['error'] = 'all ok';
            echo "<meta charset='utf-8'>";
            $message = "Creating technologies failed Error: 1";
            echo "<script type='text/javascript'>alert('$message'); history.go(-1);</script>";
            die('Error: 1' . mysqli_error($db_conx));
        }
        $count++;
    }

    $date2 = date('Y/m/d H:i:s', strtotime('+1 hours'));
    $description1 = "Please rate the alternatives, one compared to the other";


    $sql2 = "INSERT into quest VALUES (0,$research_id,'Pairwise Comparison of Alternatives','$date2','$description1',null,1,2,0)";
    echo $sql2;
    if (!mysqli_query($db_conx, $sql2)) {
        mysqli_rollback($db_conx);
        $_SESSION['error'] = 'all ok';
        echo "<meta charset='utf-8'>";
        $message = "Creating Pairwise Comparison of Alternatives failed. Error: 2";
        echo "<script type='text/javascript'>alert('$message'); history.go(-1);</script>";
        die('Error: 1' . mysqli_error($db_conx));
    }

    $quest_id = mysqli_insert_id($db_conx);

    $query2 = "SELECT * FROM technology where r_id=$research_id";
    $result = mysqli_query($db_conx, $query2);
    while ($row = mysqli_fetch_array($result)) {
        $sql1 = "INSERT INTO quest_criteria VALUES ( $quest_id," . $row['t_id'] . ",$research_id, 2)";
        if (!mysqli_query($db_conx, $sql1)) {
            mysqli_rollback($db_conx);
            $_SESSION['error'] = 'all ok';
            echo "<meta charset='utf-8'>";
            $message = "Setting technologies to questionnaire failed";
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
                $sql3 = "SELECT * from quest_alternatives where t_id1=" . $row1['c_id'] . " and t_id2=" . $row2['c_id'] . " and q_id=$quest_id";
                $result3 = mysqli_query($db_conx, $sql3);
                if (mysqli_num_rows($result3) == 0) {
                    $sql4 = "SELECT * from quest1 where t_id1=" . $row2['c_id'] . " and t_id2=" . $row1['c_id'] . " and q_id=$quest_id";
                    $result4 = mysqli_query($db_conx, $sql4);
                    if (mysqli_num_rows($result4) == 0) {
                        $sql5 = "INSERT into quest_alternatives values ($quest_id," . $row1['c_id'] . "," . $row2['c_id'] . ",$research_id);";
                        if (!mysqli_query($db_conx, $sql5)) {
                            mysqli_rollback($db_conx);
                            $_SESSION['error'] = 'all ok';
                            echo "<meta charset='utf-8'>";
                            $message = "Creating Pairwise Comparison of Alternatives failed. Servers are down. Error: 3";
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
    echo "<meta charset='utf-8'>";
    $message = "Technologies created!";
    echo "<script type='text/javascript'>alert('$message'); window.location = 'create_quest.php';</script>";
}
?>