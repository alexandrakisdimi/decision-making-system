<?php

include_once "../../dbcon.php";
session_start();
mysqli_autocommit($db_conx, FALSE);
$research_id = $_SESSION['research_id'];
$c_id = $_SESSION['criterion_id'];

echo "<meta charset='utf-8'>";

foreach ($_POST as $key => $value) {
    
    $criteriaFieldsId = explode("|", htmlspecialchars($key));
    if ($criteriaFieldsId[1] != '') {
        $query = "update sub_criteria set sub_cr_name='" . $_POST['textbox|' . $criteriaFieldsId[1]] . "', sub_cr_description='".$_POST['description|'.$criteriaFieldsId[1]]. "' where sub_criteria_id =$criteriaFieldsId[1]";
       
        if (!mysqli_query($db_conx, $query)) {
            mysqli_rollback($db_conx);
            $_SESSION['error'] = 'all ok';
            echo "<meta charset='utf-8'>";
            $message = "Η ενημέρωση των κριτηρίων απέτυχε. Error: 1";
            echo "<script type='text/javascript'>alert('$message'); history.go(-1);</script>";
            die('Error: 1' . mysqli_error($db_conx));
        }
    }
}

mysqli_commit($db_conx);
mysqli_close($db_conx);
echo "<meta charset='utf-8'>";
$message = "Τα κριτήρια ενημερώθηκαν επιτυχώς.";
echo "<script type='text/javascript'>alert('$message'); window.location = 'edit_factors.php';</script>";
?>