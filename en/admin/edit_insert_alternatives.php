<?php

include_once "../../dbcon.php";
session_start();
echo "<meta charset='utf-8'>";

$count = 1;

$research_id = $_SESSION['research_id'];


while (isset($_POST['textbox' . $count])) {
    if ($_POST['textbox' . $count] != '') {
        $sql = "INSERT INTO technology VALUES (0,$research_id,'" . $_POST['textbox' . $count] . "','" . $_POST['description' . $count] . "')";

        if (!mysqli_query($db_conx, $sql)) {
            mysqli_rollback($db_conx);
            $_SESSION['error'] = 'all ok';
            echo "<meta charset='utf-8'>";
            $message = "Η δημιουργία κριτηρίων απέτυχε. Error: 1";
            echo "<script type='text/javascript'>alert('$message'); history.go(-1);</script>";
            die('Error: 1' . mysqli_error($db_conx));
        }
        
        $c_id = mysqli_insert_id($db_conx);
        
        $select = "SELECT * from quest where type=1 and r_id=$research_id and sub=2";
        $results = mysqli_query($db_conx, $select);
        while ($row = mysqli_fetch_array($results)) {
            $sql1 = "INSERT INTO quest_alternatives VALUES ( {$row['quest_id']},$c_id,$research_id)";
            echo $sql1;
            if (!mysqli_query($db_conx, $sql1)) {
                mysqli_rollback($db_conx);
                $_SESSION['error'] = 'all ok';
                echo "<meta charset='utf-8'>";
                $message = "Η ανάθεση κριτηρίων στο ερωτηματολόγιο απέτυχε";
                echo "<script type='text/javascript'>alert('$message');";
                echo "<script>history.go(-1);</script>";
                return false;
                echo "<script>e.preventDefault();</script>";
                die('Error: ' . mysqli_error($db_conx));
            }
        }
        
    }
    $count++;
}


mysqli_commit($db_conx);
mysqli_close($db_conx);
echo "<script type='text/javascript'> window.location = 'edit_alternatives.php';</script>";
?>