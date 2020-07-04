<?php
include_once "../../dbcon.php";
session_start();

$username = rtrim($_POST['username']);
$password = md5($_POST['password']);
$password2 = md5($_POST['password2']);
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];

if ($fname == '') {
    $message = "Please enter name";
    echo "<script>alert('$message');</script>";
    echo "<script>history.go(-1);</script>";
    return false;
    echo "<script>e.preventDefault();</script>";
}

if (strlen($fname) < 3) {
    $message = "Name can't be less than 3 characters";
    echo "<script>alert('$message');</script>";
    echo "<script>history.go(-1);</script>";
    return false;
    echo "<script>e.preventDefault();</script>";
}

if ($lname == '') {
    $message = "Please enter Last Name";
    echo "<script>alert('$message');</script>";
    echo "<script>history.go(-1);</script>";
    return false;
    echo "<script>e.preventDefault();</script>";
}

if (strlen($lname) < 2) {
    $message = "Last name can't be less than 2 characters";
    echo "<script>alert('$message');</script>";
    echo "<script>history.go(-1);</script>";
    return false;
    echo "<script>e.preventDefault();</script>";
}

if ($username == '') {
    $message = "Please enter username";
    echo "<script>alert('$message');</script>";
    echo "<script>history.go(-1);</script>";
    return false;
    echo "<script>e.preventDefault();</script>";
}

if (strlen($username) < 5) {
    $message = "Username can't be less than 5 chrarcters";
    echo "<script>alert('$message');</script>";
    echo "<script>history.go(-1);</script>";
    return false;
    echo "<script>e.preventDefault();</script>";
}

if ($password == '') {
    $message = "Please enter password";
    echo "<script>alert('$message');</script>";
    echo "<script>history.go(-1);</script>";
    return false;
    echo "<script>e.preventDefault();</script>";
}

if (strlen($password) < 6) {
    $message = "Password can't be less than 6 characters";
    echo "<script>alert('$message');</script>";
    echo "<script>history.go(-1);</script>";
    return false;
    echo "<script>e.preventDefault();</script>";
}

if ($password != $password2) {
    $message = "Passwords do not match.";
    echo "<script>alert('$message');</script>";
    echo "<script>history.go(-1);</script>";
    return false;
    echo "<script>e.preventDefault();</script>";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $message = "Wrong type of email";
    echo "<script>alert('$message');</script>";
    echo "<script>history.go(-1);</script>";
    return false;
    echo "<script>e.preventDefault();</script>";
}

$query = "SELECT * from users where username='$username'";
$result = mysqli_query($db_conx, $query);

if (mysqli_num_rows($result)>0) {
    $message = "Username already exists";
    echo "<script>alert('$message');</script>";
    echo "<script>history.go(-1);</script>";
    return false;
    echo "<script>e.preventDefault();</script>";
}

$sql = "INSERT INTO users VALUES (0, '$username','$password','$email','$fname','$lname','administrator',1)";
$result = mysqli_query($db_conx, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($db_conx), E_USER_ERROR);

$_SESSION['error'] = 'all ok';
mysqli_commit($db_conx);
mysqli_close($db_conx);
$message = "User Created";
echo "<script type='text/javascript'>alert('$message'); window.location = 'main.php';</script>";
?>

