<?php
include_once "../../dbcon.php";
session_start();
echo "<meta charset='utf-8'>";
mysqli_autocommit($db_conx, FALSE);
$quest_id = $_SESSION['quest_id'];
$research_id = $_SESSION['research_id'];
$quest_type = $_SESSION['quest_type']; 


$description = $_POST['description'];
if ($_POST['description']==''){
        mysqli_commit($db_conx);
        mysqli_close($db_conx);
        $message = "H περιγραφή του κριτηρίου #$count είναι κενή";
        echo "<script>alert('$message');</script>";
        echo "<script>history.go(-1);</script>";
        return false;
        echo "<script>e.preventDefault();</script>";
    }


while (isset($_POST['textbox'.$count])) {
    
    if ($_POST['textbox'.$count]==''){
        mysqli_commit($db_conx);
        mysqli_close($db_conx);
        $message = "Το όνομα του χαρακτηριστικού #$count είναι κενό";
        echo "<script>alert('$message');</script>";
        echo "<script>history.go(-1);</script>";
        return false;
        echo "<script>e.preventDefault();</script>";
    }
    
    if ($_POST['unit'.$count]==''){
        mysqli_commit($db_conx);
        mysqli_close($db_conx);
        $message = "Η μονάδα μέτρησης του χαρακτηριστικού #$count είναι κενή";
        echo "<script>alert('$message');</script>";
        echo "<script>history.go(-1);</script>";
        return false;
        echo "<script>e.preventDefault();</script>";
    }
    
    if (isset($_POST['check'.$count])){
        if (($_POST['from'.$count]== '') || ($_POST['to'].$count)){
            mysqli_commit($db_conx);
            mysqli_close($db_conx);
            $message = "Το πεδίο ορισμού του χαρακτηριστικού #$count είναι κενό";
            echo "<script>alert('$message');</script>";
            echo "<script>history.go(-1);</script>";
            return false;
            echo "<script>e.preventDefault();</script>"; 
        }
    }
}

if($quest_type==2){
    $sql = "UPDATE quest2 set  ";
}

?>