<?php

include_once "../../dbcon.php";
session_start();
mysqli_autocommit($db_conx, FALSE);
$research_id = $_SESSION['research_id'];

echo "<meta charset='utf-8'>";

$count = 1;
$sub = 0;

foreach ($_POST as $key => $value) {
    $criteriaFieldsId = explode("|", htmlspecialchars($key));
    if ($criteriaFieldsId[1] != '') {
        $query = "update criteria set c_name='" . $_POST['textbox|' . $criteriaFieldsId[1]] . "', sub_criteria=1, c_description='".$_POST['description|'.$criteriaFieldsId[1]]. "' where criterion_id =$criteriaFieldsId[1]";
 
        if (!mysqli_query($db_conx, $query)) {
            mysqli_rollback($db_conx);
            $_SESSION['error'] = 'all ok';
            echo "<meta charset='utf-8'>";
            $message = "Η ενημέρωση των κριτηρίων απέτυχε. Error: 1";
            echo "<script type='text/javascript'>alert('$message'); history.go(-1);</script>";
            die('Error: 1' . mysqli_error($db_conx));
        }
        $count++;
    }
}





/* while (isset($_POST['textbox'.$count])) {
  $criterion=$_POST['c_id'.$count];
  if($criterion!=''){
  $sql= " SELECT * from criteria where criterion_id=$criterion";
  $result = mysqli_query($db_conx, $sql);
  if(mysqli_num_rows($result) > 0){
  $row = mysqli_fetch_array($result);
  if (isset($_POST['check'.$count])){
  $query = "UPDATE criteria set c_name='".$_POST['textbox'.$count]."', sub_criteria=1 where criterion_id=".$row['criterion_id'];
  $sub=1;
  }
  else{
  $query = "UPDATE criteria set c_name='".$_POST['textbox'.$count]."', sub_criteria=0 where criterion_id=".$row['criterion_id'];
  $query2 = "SELECT * from sub_criteria where c_id=".$_POST['c_id'.$count];
  $result2 = mysqli_query($db_conx,$query2);
  if(mysqli_num_rows($result2) > 0){
  $query3 = "DELETE from sub_criteria where c_id=".$_POST['c_id'.$count];
  if (!mysqli_query($db_conx,$query3))
  {
  mysqli_rollback($db_conx);
  $_SESSION['error']='all ok';
  echo "<meta charset='utf-8'>";
  $message = "Η διαγραφή των υποκριτηρίων απέτυχε. Error: 1";
  echo "<script type='text/javascript'>alert('$message'); history.go(-1);</script>";
  die('Error: 1' . mysqli_error($db_conx));
  }
  }

  }

  if (!mysqli_query($db_conx,$query))
  {
  mysqli_rollback($db_conx);
  $_SESSION['error']='all ok';
  echo "<meta charset='utf-8'>";
  $message = "Η ενημέρωση των κριτηρίων απέτυχε. Error: 1";
  echo "<script type='text/javascript'>alert('$message'); history.go(-1);</script>";
  die('Error: 1' . mysqli_error($db_conx));
  }

  }
  }
  else{
  if (isset($_POST['check'.$count])){
  $sql = "INSERT INTO criteria VALUES (0,{$_SESSION['research_id']},'".$_POST['textbox'.$count]."',1)";
  $sub=1;
  }
  else{
  $sql = "INSERT INTO criteria VALUES (0,{$_SESSION['research_id']},'".$_POST['textbox'.$count]."',0)";
  }

  if (!mysqli_query($db_conx,$sql)){
  mysqli_rollback($db_conx);
  $_SESSION['error']='all ok';
  echo "<meta charset='utf-8'>";
  $message = "Η δημιουργία κριτηρίων απέτυχε. Error: 1";
  echo "<script type='text/javascript'>alert('$message'); history.go(-1);</script>";
  die('Error: 1' . mysqli_error($db_conx));
  }
  }

  $count++;
  }

  $sql="DELETE from criteria where c_name=''";
  if (!mysqli_query($db_conx,$sql))
  {
  mysqli_rollback($db_conx);
  $_SESSION['error']='all ok';
  echo "<meta charset='utf-8'>";
  $message = "Δεν βρήκα κενά πουθενά. Error: 1";
  echo "<script type='text/javascript'>alert('$message'); history.go(-1);</script>";
  die('Error: 1' . mysqli_error($db_conx));
  }


  if ($sub==0)
  {
  mysqli_commit($db_conx);
  mysqli_close($db_conx);
  echo "<meta charset='utf-8'>";
  $message = "Τα κριτήρια ενημερώθηκαν επιτυχώς. Πάμε για ερωτηματολόγιο";
  echo "<script type='text/javascript'>alert('$message'); window.location = 'edit_quest.php';</script>";
  }
  else if ($sub==1){ */
mysqli_commit($db_conx);
mysqli_close($db_conx);
echo "<meta charset='utf-8'>";
$message = "Τα κριτήρια ενημερώθηκαν επιτυχώς.";
echo "<script type='text/javascript'>alert('$message');window.location = 'edit_criteria.php'; </script>";
/* }
  else {
  mysqli_commit($db_conx);
  mysqli_close($db_conx);
  echo "<meta charset='utf-8'>";
  $message = "Servers are down!!";
  echo "<script type='text/javascript'>alert('$message'); window.location = 'edit_criteria.php';</script>";
  }
 */
?>

