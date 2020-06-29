<!--HEADER-->
<?php
include_once "header.php";
include_once "../../dbcon.php";
?>
<!--SIDEBAR-->
<?php
include_once "sidebar.php";
?>

<!--CONTENT-->

<h3>Choose a research you want to export results.</h3>

<?php
$date = date('Y/m/d H:i:s', strtotime('+1 hours'));
$result = mysqli_query($db_conx, $query);

$sql = "SELECT * from research where completed!=0";
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
    echo '<a style="{color: royalblue;} :visited{color: royalblue;}" href="'.$research_name.'.xlsx" ><h3 style="color: royalblue"><li style="list-style: square;">' . $row2['rname'] . '</li></h3>';

    echo '</ul>';
}
?>  

<!--FOOTER-->
<?php include_once "footer.php"; ?>