<?php
include_once "../../dbcon.php";
session_start();
ob_start();
echo "<meta charset='utf-8'>";
$name = rtrim($_POST['research']);
$description = rtrim($_POST['description']);

$date = $_POST['inputField']; //Sets your date string

if($name==''){
    $message = "Enter name of research";
    echo "<script>alert('$message');</script>";
    echo "<script>history.go(-1);</script>";
    return false;
    echo "<script>e.preventDefault();</script>";
}

if(strlen($name)<3) {
    $message = "Name can't be less than 3 characters";
    echo "<script>alert('$message');</script>";
    echo "<script>history.go(-1);</script>";
    return false;
    echo "<script>e.preventDefault();</script>";
}

if($date==''){
    $message = "Select date";
    echo "<script>alert('$message');</script>";
    echo "<script>history.go(-1);</script>";
    return false;
    echo "<script>e.preventDefault();</script>";
}

if($description==''){
    $message = "Enter description";
    echo "<script>alert('$message');</script>";
    echo "<script>history.go(-1);</script>";
    return false;
    echo "<script>e.preventDefault();</script>";
}

if(strlen($description)<10) {
    $message = "Description can't be less than 10 characters";
    echo "<script>alert('$message');</script>";
    echo "<script>history.go(-1);</script>";
    return false;
    echo "<script>e.preventDefault();</script>";
}


mysqli_autocommit($db_conx, FALSE);

$time_epoch = strtotime($date); //Converts the string into an epoch time
$new_date_time = date('Y-m-d', $time_epoch).' '.$_POST['defaultEntry'].':00';

$date2 = date('Y/m/d H:i:s', strtotime('+1 hours'));
$sql = "INSERT INTO research VALUES (0,'$name', '$date2' , '$new_date_time', '$description', 0,0)";
$result = mysqli_query($db_conx, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($db_conx), E_USER_ERROR);

$research_id = mysqli_insert_id($db_conx);


$_SESSION['research_id']=$research_id;
mysqli_commit($db_conx);
mysqli_close($db_conx);
$message = "Research created!!";
echo "<script type='text/javascript'>alert('$message'); window.location = 'create_criteria.php'</script>";

?>