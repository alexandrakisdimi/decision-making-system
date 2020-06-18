<?php

include_once "../../dbcon.php";
session_start();
mysqli_autocommit($db_conx, FALSE);


$research=$_SESSION['research_id'];

$sql = "DELETE FROM research_user WHERE r_id = $research";
if (!mysqli_query($db_conx,$sql)) {
    mysqli_rollback($db_conx);
    $_SESSION['error']='all ok';
    echo "<meta charset='utf-8'>";
    $message = "Setting users failed. Error 1";
    echo "<script type='text/javascript'>alert('$message'); window.location = 'select_users.php';</script>";
  die('Error: ' . mysqli_error($db_conx));
}


if(!empty($_POST['check_list'])) {
    foreach($_POST['check_list'] as $check) {
          $sql = "INSERT INTO research_user VALUES ( $research,".$check.", 0)";
            if (!mysqli_query($db_conx,$sql)) {
                mysqli_rollback($db_conx);
                $_SESSION['error']='all ok';
                echo "<meta charset='utf-8'>";
                $message = "Setting users failed. Error 2";
                echo "<script type='text/javascript'>alert('$message'); window.location = 'select_users.php';</script>";
                die('Error: ' . mysqli_error($db_conx));
            } 
    }
}


$_SESSION['error']='all ok';
mysqli_commit($db_conx);
mysqli_close($db_conx);

echo "<meta charset='utf-8'>";
$message = "Success!";
unset($_SESSION['research_id']);
echo "<script type='text/javascript'>alert('$message'); window.location = 'research_to_user.php';</script>";

?>