<?php
include_once "header.php";
include_once "../../dbcon.php";
?>

<h2>Select research</h2>
<h3>Researches are viewed by expiration date (Descendind)</h3>

<form method="post" action="select_users.php" id="myForm">
    <?php
    $date = date('Y/m/d H:i:s', strtotime('+1 hours'));
    $query = "SELECT * FROM research where end_date>'$date' and published=0 ORDER BY end_date DESC";
    $result = mysqli_query($db_conx, $query);
    while ($row = mysqli_fetch_array($result)) {
        echo "<input type='radio' name='mode' value='" . $row['research_id'] . "'>" . $row['rname'] . " --> Expiration Date: " . $row['end_date'] . "<br />";
    }
    ?>  
    <a href="#!" onclick="document.getElementById('myForm').submit();" style=" margin-top:20px;" class="button icon arrowright"/> Next</a>
</form>

<?php
include_once "footer.php";
?>

