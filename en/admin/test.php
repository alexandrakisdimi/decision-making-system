<!--HEADER-->
<?php
include_once "header.php";
include_once "../../dbcon.php";
?>
<!--SIDEBAR-->
<?php
include_once "sidebar.php";
?>

<?php
//decrypt research_id from url
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

$research_id = decrypt_url($_GET['research_id']);
?>


<!--CONTENT-->
<?php
$sql = "SELECT * from research where research_id = $research_id";
$result = mysqli_query($db_conx, $sql);
$row = mysqli_fetch_array($result);

echo "<h3>Έχετε επιλέξει την έρευνα: <label style='color: red;'>" . $row['rname'] . "</h3>";

?>

<?php
if (!extension_loaded('lapack')) die('skip');
?>
<!--FILE-->
<?php

function printEigVal($e) {
    echo ($e < 0 ? '' : ' '), sprintf("%01.2f", $e);
}

function printEig($e) {
    foreach( $e as $row ) {
        echo "<br/>";
        foreach( $row as $col ) {
            if(count($col) == 1) {
                echo " ", printEigVal($col[0]);
            } else {
                echo "( ", printEigVal($col[0]), ", ", printEigVal($col[1]), ") ";
            }
        }
        echo "\n";
    }
    echo "\n";
}



$a = [
    [1,3,3],
    [1,1,2],
    [1,2,1]
];


$result = Lapack::eigenValues($a);
// round the result so we have a chance of matching in the face of float variance
foreach($result as $k => $r) {
    foreach($r as $ik => $ir) {
        $result[$k][$ik] = round($ir, 2);
    }
}
var_dump($result);

echo '<pre>'; print_r($result); echo '</pre>';

$leftEig = array();
$result = Lapack::eigenValues($a, $leftEig);
echo "<br/>Left eigenvectors\n";
echo '<pre>'; print_r($leftEig); echo '</pre>';

$rightEig = array();
$result = Lapack::eigenValues($a, null, $rightEig);
echo "<br/>Right eigenvectors\n";

echo '<pre>'; print_r($rightEig); echo '</pre>';
printEig($rightEig);

?>



<!--FOOTER-->
<?php include_once "footer.php"; ?>