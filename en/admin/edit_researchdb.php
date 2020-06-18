<?php
include_once "../../dbcon.php";
session_start();
mysqli_autocommit($db_conx, FALSE);
$research_name = $_POST['research'];
$research_id = $_SESSION['research_id'];
$description=$_POST['description'];

$date = $_POST['inputField']; //Sets your date string
$time_epoch = strtotime($date); //Converts the string into an epoch time
$new_date_time = date('Y-m-d', $time_epoch).' '.$_POST['defaultEntry'].':00';

$sql = "update research set rname= '$research_name', end_date='$new_date_time', description='$description'  where research_id = $research_id";
if (!mysqli_query($db_conx,$sql)) {
    mysqli_rollback($db_conx);
    echo "<meta charset='utf-8'>";
    $message = "Η ενημέρωση των δεδομένων απέτυχε";
    echo "<script type='text/javascript'>alert('$message'); history.go(-1)';</script>";
    die('Error2: ' . mysqli_error($db_conx));
}

$sql2 = "update quest set edited=0 where r_id=$research_id";
if (!mysqli_query($db_conx,$sql2)) {
    mysqli_rollback($db_conx);
    echo "<meta charset='utf-8'>";
    $message = "Η ενημέρωση των δεδομένων του ερωτηματολογίου απέτυχε";
    echo "<script type='text/javascript'>alert('$message'); history.go(-1)';</script>";
    die('Error2: ' . mysqli_error($db_conx));
}

mysqli_commit($db_conx);
mysqli_close($db_conx);
echo "<meta charset='utf-8'>";
$message = "Η ενημέρωση των δεδομένων ήταν επιτυχής";
echo "<script type='text/javascript'>alert('$message'); window.location = 'edit_criteria.php';</script>";


?>