<?php
include_once "header.php";
include_once "../../dbcon.php";
?>

<!-----------------------SIDEBAR---------------------->



<h2>Επεξεργαστείτε μία έρευνα ή δημοσιοποιήστε την</h2>

<?php

function encrypt_url($string) {
    $key = "MAL_979805"; //key to encrypt and decrypts.
    $result = '';
    $test = [];
    for ($i = 0; $i < strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key)) - 1, 1);
        $char = chr(ord($char) + ord($keychar));

        $test[$char] = ord($char) + ord($keychar);
        $result.=$char;
    }

    return urlencode(base64_encode($result));
}

$date = date('Y/m/d H:i:s', strtotime('+1 hours'));
$query = "SELECT * FROM research where completed=0 ORDER BY now_date ASC";
$result = mysqli_query($db_conx, $query);
while ($row = mysqli_fetch_array($result)) {
    echo "<label>" . $row['rname'] . "</label>";
    if ($row['published'] == 0) {
        
        echo "<a href='edit_research.php?research=" . encrypt_url($row['research_id']) . "' style='float:right; margin-left:0px;margin-right:20px;' class='button icon edit' type='submit'>Edit</a>";
        echo "<a href='publish.php?research=" . encrypt_url($row['research_id']) . "' style='float:right; margin-left:5px; margin-right:10px; ' class='button icon approve' type='submit'>Publish</a><br /><br />";
    } else {
         
        echo "<a href='javascript:void(0)' style='opacity:0.5; float:right; margin-left:0px; margin-right:20px;' class='button icon edit' type='submit'>Edit</a>";
        echo "<a href='javascript:void(0)' style='opacity:0.5; float:right; margin-left:5px; margin-right:10px;' class='button icon approve' type='submit'>Publish</a>";
        echo "<a href='complete.php?research=" . encrypt_url($row['research_id']) . "' style='float:right; margin-right:10px;' class='button icon key' type='submit'>Complete</a><br /><br />";
        
    }
}

if(mysqli_num_rows($result)==0){
    echo "<h4>Δεν υπάρχουν τρέχων έρευνες</h4>";
}

?>  

<?php
include_once "footer.php";
?>

