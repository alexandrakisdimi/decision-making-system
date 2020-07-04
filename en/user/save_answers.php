<?php

include_once "../../dbcon.php";
session_start();

mysqli_autocommit($db_conx, FALSE);
$user_id = $_SESSION['user'];
$research_id = $_SESSION['research_id'];
$sql = "delete from answers where r_id=$research_id and u_id = $user_id";
mysqli_query($db_conx, $sql);
$sql = "delete from technology_answers where r_id=$research_id and u_id = $user_id";
mysqli_query($db_conx, $sql);


foreach ($_POST as $key => $value) {
    $criteriaFieldsId = explode("|", htmlspecialchars($key));
    $query = "select * from quest where quest_id =$criteriaFieldsId[0]";
    $result = mysqli_query($db_conx, $query);
    $row = mysqli_fetch_array($result);
    if ($row['sub'] == 2) {
        $sql = "insert into technology_answers values($research_id, $criteriaFieldsId[0], $user_id,  $criteriaFieldsId[1], $criteriaFieldsId[2], $criteriaFieldsId[3], " . htmlspecialchars($value) . ")";
        $sql2 = "insert into technology_answers values($research_id, $criteriaFieldsId[0], $user_id,  $criteriaFieldsId[2], $criteriaFieldsId[1],$criteriaFieldsId[3] , 1/(" . htmlspecialchars($value) . "))";
        $sql3 = "insert into technology_answers values($research_id, $criteriaFieldsId[0], $user_id,  $criteriaFieldsId[1], $criteriaFieldsId[1],$criteriaFieldsId[3] , 1)";
        $sql4 = "insert into technology_answers values($research_id, $criteriaFieldsId[0], $user_id,  $criteriaFieldsId[2], $criteriaFieldsId[2],$criteriaFieldsId[3] , 1)";
    } else {
        $sql = "insert into answers values($criteriaFieldsId[0], $user_id, $research_id, $criteriaFieldsId[1], $criteriaFieldsId[2], " . htmlspecialchars($value) . ")";
        $sql2 = "insert into answers values($criteriaFieldsId[0], $user_id, $research_id, $criteriaFieldsId[2], $criteriaFieldsId[1], 1/(" . htmlspecialchars($value) . "))";
        $sql3 = "insert into answers values($criteriaFieldsId[0], $user_id, $research_id, $criteriaFieldsId[1], $criteriaFieldsId[1], 1)";
        $sql4 = "insert into answers values($criteriaFieldsId[0], $user_id, $research_id, $criteriaFieldsId[2], $criteriaFieldsId[2], 1)";
    }
    mysqli_query($db_conx, $sql);
    mysqli_query($db_conx, $sql2);
    try {
        mysqli_query($db_conx, $sql3);
    } catch (Exception $ex) {
        
    }
    try {
        mysqli_query($db_conx, $sql4);
    } catch (Exception $ex) {
        
    }
}

function encrypt_url($string) {
        $key = "MAL_979805"; //key to encrypt and decrypts.
        $result = '';
        $test = [];
        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) + ord($keychar));

            $test[$char] = ord($char) + ord($keychar);
            $result.=$char;
        }

        return urlencode(base64_encode($result));
    }

$research_id= encrypt_url($research_id);    

mysqli_commit($db_conx);
mysqli_close($db_conx);
$message = "Οι απαντήσεις σας αποθηκέυτηκαν.\nΕυχαριστούμε για την συμμετοχή σας.";
echo "<script type='text/javascript'>alert('$message'); history.go(-1);</script>";
header('Location: answer.php?research_id='.$research_id);
?>