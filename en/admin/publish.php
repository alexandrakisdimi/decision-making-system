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

$select = "SELECT * from research_user where r_id = $research_id";
$result = mysqli_query($db_conx, $select);
if (mysqli_num_rows($result) <= 0) {
    echo "<meta charset='utf-8'>";
    $message = "You need to choose users to answer the questionnaires before publishing the research";
    echo "<script type='text/javascript'>alert('$message'); window.location = 'select_users.php';</script>";
    die('Error: ' . mysqli_error($db_conx));

    mysqli_commit($db_conx);
    mysqli_close($db_conx);
}


$sql = "update research set published = 1 where research_id = $research_id";
if (!mysqli_query($db_conx, $sql)) {
    mysqli_rollback($db_conx);
    $_SESSION['error'] = 'all ok';
    echo "<meta charset='utf-8'>";
    $message = "Publish failed";
    echo "<script type='text/javascript'>alert('$message'); window.location = 'edit_publish.php';</script>";
    die('Error: ' . mysqli_error($db_conx));
}

$_SESSION['error'] = 'all ok';
echo "<meta charset='utf-8'>";
$message = "Publish complete";
echo "<script type='text/javascript'>alert('$message'); window.location = 'edit_publish.php';</script>";
?>