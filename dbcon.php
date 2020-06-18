<?php
$db_conx = mysqli_connect("127.0.0.1", "db_user", "password", "skatz");
//mysql_query("SET NAMES 'utf8'");
//mysql_query("SET CHARACTER SET 'utf8'");
mysqli_set_charset($db_conx,'utf8');
// Evaluate the connection
if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
    exit();
} ?>