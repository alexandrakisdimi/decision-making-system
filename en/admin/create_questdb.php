<?php
include_once "../../dbcon.php";
session_start();
echo "<meta charset='utf-8'>";

mysqli_autocommit($db_conx, FALSE);
$quest = $_POST['quest'];
$quest_type=$_POST['quest_type'];
$description=$_POST['description'];
$research_id=$_SESSION['research_id'];
$c_id=$_POST['c_id'];
$date2 = date('Y/m/d H:i:s', strtotime('+1 hours'));

if($quest==''){
    $message = "Το όνομα του ερωτηματολογίου είναι κενό";
    echo "<script>alert('$message');</script>";
    return false;
    echo "<script>e.preventDefault();</script>";
    echo "<script>history.go(-1);</script>";
}

if(strlen($quest)<3) {
    $message = "Το όνομα του ερωτηματολογίου δεν μπορεί να είναι μικρότερο απο 3 χαρακτήρες";
    echo "<script>alert('$message');</script>";
    return false;
    echo "<script>e.preventDefault();</script>";
    echo "<script>history.go(-1);</script>";
}

if($description==''){
    $message = "Η περιγραφή του ερωτηματολογίου είναι κενή";
    echo "<script>alert('$message');</script>";
    return false;
    echo "<script>e.preventDefault();</script>";
    echo "<script>history.go(-1);</script>";
}

if(strlen($description)<3) {
    $message = "Η περιγραφή του ερωτηματολογίου δεν μπορεί να είναι μικρότερη απο 10 χαρακτήρες";
    echo "<script>alert('$message');</script>";
    return false;
    echo "<script>e.preventDefault();</script>";
    echo "<script>history.go(-1);</script>";
}

if($quest_type!=2 && $quest_type!=3){
    $message = "Δεν έχετε επιλέξει τύπο ερωτηματολογίου";
    echo "<script>alert('$message');</script>";
    return false;
    echo "<script>e.preventDefault();</script>";
    echo "<script>history.go(-1);</script>";
}

if($c_id < 0){
    $message = "Δεν έχετε επιλέξει κριτήριο";
    echo "<script>alert('$message');</script>";
    return false;
    echo "<script>e.preventDefault();</script>";
    echo "<script>history.go(-1);</script>";
}


if($quest_type==2)
{
    $sql = "INSERT INTO quest VALUES (0,$research_id, '$quest', '$date2','$description',$c_id,2,1,0)";
    if (!mysqli_query($db_conx,$sql)) {
        mysqli_rollback($db_conx);
        $_SESSION['error']='all ok';
        echo "<meta charset='utf-8'>";
        $message = "Η δημιουργία ερωτηματολογίου τύπου 2 απέτυχε. Servers are down. Error: 1";
        echo "<script type='text/javascript'>alert('$message'); history.go(-1);</script>";
        die('Error: 2 ' . mysqli_error($db_conx));
    }
    
    $quest_id = mysqli_insert_id($db_conx);

    $query = "SELECT * from sub_criteria where c_id=$c_id";
    $result = mysqli_query($db_conx, $query);
    while ($row = mysqli_fetch_array($result)){
        $id=$row['sub_criteria_id'];
        $sql2 = "INSERT INTO quest2 VALUES ($quest_id,$id,$research_id,'','','')";
        if (!mysqli_query($db_conx,$sql2)) {
            mysqli_rollback($db_conx);
            $_SESSION['error']='all ok';
            echo "<meta charset='utf-8'>".$sql2;
            $message = "Η δημιουργία ερωτηματολογίου τύπου 2 απέτυχε. Servers are down. Error: 2";
            echo "<script type='text/javascript'>alert('$sql2');</script>";
            die('Error: 2.5  ' . mysqli_error($db_conx));
        }
    }
    
}else if($quest_type==3)
{
    $sql = "INSERT INTO quest VALUES (0,$research_id, '$quest', '$date2','$description',3,1,0)";
    if (!mysqli_query($db_conx,$sql)) {
        mysqli_rollback($db_conx);
        $_SESSION['error']='all ok';
        echo "<meta charset='utf-8'>";
        $message = "Η δημιουργία ερωτηματολογίου τύπου 3 απέτυχε. Servers are down. Error: 1";
        echo "<script type='text/javascript'>alert('$message'); history.go(-1);</script>";
        die('Error: 2 ' . mysqli_error($db_conx));
    }
    
    $quest_id = mysqli_insert_id($db_conx);

    $query = "SELECT * from sub_criteria where c_id=$c_id";
    $result = mysqli_query($db_conx, $query);
    while ($row = mysqli_fetch_array($result)){
        $id=$row['sub_criteria_id'];
        $sql2 = "INSERT INTO quest3 VALUES ($quest_id,$id,$research_id,'','','')";
        if (!mysqli_query($db_conx,$sql2)) {
            mysqli_rollback($db_conx);
            $_SESSION['error']='all ok';
            echo "<meta charset='utf-8'>";
            $message = "Η δημιουργία ερωτηματολογίου τύπου 3 απέτυχε. Servers are down. Error: 3";
            echo "<script type='text/javascript'>alert('$message'); history.go(-1);</script>";
            die('Error: 2 ' . mysqli_error($db_conx));
        }
    }
}
  
$_SESSION['quest_type']=$quest_type;
$_SESSION['quest_id']=$quest_id;
mysqli_commit($db_conx);
mysqli_close($db_conx);
if($quest_type==2){
    echo "<script type='text/javascript'>window.location = 'quest2.php';</script>";
}
else if($quest_type==3){
    echo "<script type='text/javascript'>window.location = 'quest3.php';</script>";
}

?>

