<?php
include_once "header.php";
include_once "../../dbcon.php";
?>

<h2>Select users</h2>
<form method="post" action="select_usersdb.php" id="myForm">
    <?php
    $research_id = $_POST['mode']; 
    $_SESSION['research_id'] = $research_id; 
    $query2 = "SELECT * from users where type='user'";
    $result2 = mysqli_query($db_conx, $query2);
    while ($row2 = mysqli_fetch_array($result2)) {
        $query3 = "SELECT * from research_user where u_id=" . $row2['user_id'] . " and r_id =$research_id;";
        $result3 = mysqli_query($db_conx, $query3);
        if (mysqli_fetch_array($result3))
            echo "<input type='checkbox' name='check_list[]'  value='" . $row2['user_id'] . "' checked>" . $row2['fname'] . " " . $row2['lname'] . "</input>";
        else
            echo "<input type='checkbox' name='check_list[]'  value='" . $row2['user_id'] . "'>" . $row2['fname'] . " " . $row2['lname'] . "</input>";
    }
    ?>

    <br />
    <a href="#!" onclick ="document.getElementById('myForm')" style="margin-top:20px;" class="button icon approve"/>Save </a>
</form>


<?php
include_once "footer.php";
?>


