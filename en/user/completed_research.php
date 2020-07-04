<!--HEADER-->
<?php
include_once "header.php";
include_once '../../dbcon.php';
?>
<!--SIDEBAR-->
<?php
include_once "sidebar.php";
?>

<!--CONTENT-->

<h3>Choose a research to view their results</h3>

<?php

$sqlUser = "SELECT * from research_user where u_id={$_SESSION['user']}";
$resultUser = mysqli_query($db_conx, $sqlUser);

while ($rowUser=mysqli_fetch_array($resultUser)){

$sql = "SELECT * from research where completed=1 and research_id={$rowUser['r_id']}";
$result1 = mysqli_query($db_conx, $sql);

while ($row2 = mysqli_fetch_array($result1)) {
    $sqlName = "Select * from research where research_id = {$row2['research_id']}";
    $resultName = mysqli_query($db_conx, $sqlName);
    while ($rowName = mysqli_fetch_array($resultName)) {
        $research_name = $rowName['rname'];
        $name = explode(" ", $research_name);
        $num_of_words = count($name);
    }
    $research_name = "";

    for ($i = 0; $i < $num_of_words; $i++) {
        $research_name .= $name[$i] . '_';
    }

    $research_name .='Results';
    echo '<ul>';
    echo '<a style="{color: royalblue;} :visited{color: royalblue;}" href="../admin/'.$research_name.'.xlsx" ><h3 style="color: royalblue"><li style="list-style: square;">' . $row2['rname'] . '</li></h3>';

    echo '</ul>';
}}
?>  

<!--FOOTER-->
<?php include_once "footer.php"; ?>