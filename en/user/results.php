<?php
include_once "header.php";
include_once "../../dbcon.php";
?>

--TEST--
Calculate the eigenvalues and the left and right eigenvectors of a matrix
--SKIPIF--
<?php
if (!extension_loaded('lapack')) die('skip');
?>
--FILE--
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

echo "<br/> RESULTS <br/>";
$a = array(
    array( 1,   0.5,  0.333333, 0.3333333),
    array( 0.5,   1,  2),
    array( 0.33,   0.5,  1),
);


$result = Lapack::eigenValues($a);
// round the result so we have a chance of matching in the face of float variance
foreach($result as $k => $r) {
    foreach($r as $ik => $ir) {
        $result[$k][$ik] = round($ir, 2);
    }
}
var_dump($result);

$leftEig = array();
$result = Lapack::eigenValues($a, $leftEig);
echo "<br/>Left eigenvectors\n";
printEig($leftEig);

$rightEig = array();
$result = Lapack::eigenValues($a, null, $rightEig);
echo "<br/>Right eigenvectors\n";
printEig($rightEig);

?>

<?php
include_once "footer.php";
?>
