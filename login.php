<?php
include_once "dbcon.php";
session_start();

$username = $_POST['username'];
$password = $_POST['password'];
$password = MD5($password);

$sql = "SELECT * from users where username='$username' and password='$password'";
$result = mysqli_query($db_conx,$sql);
if ($row = mysqli_fetch_array($result)) {
    
    if($row['validate']==0){
        mysqli_close($db_conx);
        echo "<meta charset='utf-8'>";
        $message = "You have not verified your email. Please check your inbox.";
        echo "<script type='text/javascript'>alert('$message'); window.location = 'index.php#login';</script>";
        return false;
    }
    
    echo $row['type'];
    if($row['type']=='user')
    {
        session_regenerate_id();
        $_SESSION['user'] = $row['user_id'];
        $_SESSION['type'] = $row['type'];
        session_write_close();
        header('Location: ./en/user/user_main.php');
    }
    else if (strcasecmp( $row['type'], 'admin' ) == 0)
    {
        session_regenerate_id();
        $_SESSION['user'] = $row['user_id'];
        $_SESSION['type'] = $row['type'];
        session_write_close();
        header('Location: ./en/admin/main.php');
    }
    
    if (!mysqli_query($db_conx,$sql)) 
    {
            mysqli_rollback($db_conx);
            $_SESSION['error']='all ok';
            echo "<meta charset='utf-8'>";
            $message = "Connection Refused : Servers are under maintenance";
            echo "<script type='text/javascript'>alert('$message'); history.go(-1);</script>";
            die('Error: 1' . mysqli_error($db_conx));
    }
    
}


$_SESSION['error']='all ok';
mysqli_close($db_conx);
echo "<meta charset='utf-8'>";
$message = "Login Failed. Please check your username and/or password";
echo "<script type='text/javascript'>alert('$message'); window.location = 'index.php#login';</script>";


?>

