<?php

//Start session
session_start();
include_once 'dbcon.php';

function decrypt_url($string) {
    $key = "MAL_979805"; //key to encrypt and decrypts.
    $result = '';
    $string = base64_decode(urldecode($string));
    for ($i = 0; $i < strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key)) - 1, 1);
        $char = chr(ord($char) - ord($keychar));
        $result.=$char;
    }
    return $result;
}

$research_id = decrypt_url($_GET['research_id']);
$user_id = $_SESSION['user'];

$sql = "DELETE from answers where r_id=$research_id and u_id=$user_id";
if (!mysqli_query($db_conx, $sql)) {
    mysqli_rollback($db_conx);
    $_SESSION['error'] = 'all ok';
    echo "<meta charset='utf-8'>";
    $message = "Η επαναφορά των πεδίων απέτυχε";
    echo "<script type='text/javascript'>alert('$message');";
    echo "<script>history.go(-1);</script>";
    return false;
    echo "<script>e.preventDefault();</script>";
    die('Error: 2 ' . mysqli_error($db_conx));
}

mysqli_commit($db_conx);
mysqli_close($db_conx);
echo "<meta charset='utf-8'>";
$message = "Η επαναφορά των πεδίων ήταν επιτυχής";
echo "<script type='text/javascript'>alert('$message'); window.location = 'mainuser.php?research_id=".$_GET['research_id']."';</script>";

?>