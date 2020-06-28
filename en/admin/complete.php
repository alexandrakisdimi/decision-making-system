<?php

include_once "../../dbcon.php";
session_start();
mysqli_autocommit($db_conx, FALSE);

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

$research_id = decrypt_url($_GET['research']);


$sql = "update research set completed = 1 where research_id = $research_id";
if (!mysqli_query($db_conx, $sql)) {
    mysqli_rollback($db_conx);
    $_SESSION['error'] = 'all ok';
    echo "<meta charset='utf-8'>";
    $message = "Η ολοκλήρωση της έρευνας απέτυχε. Error: 1";
    echo "<script type='text/javascript'>alert('$message'); window.location = 'edit_publish.php';</script>";
    die('Error: ' . mysqli_error($db_conx));
}

$_SESSION['error'] = 'all ok';
echo "<meta charset='utf-8'>";
$message = "Η ολοκλήρωση της έρευνας ήταν επιτυχής";
echo "<script type='text/javascript'>alert('$message'); window.location = 'edit_publish.php';</script>";
?>