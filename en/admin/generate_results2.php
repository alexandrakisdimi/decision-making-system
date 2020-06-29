<!--HEADER-->
<?php
include_once "header.php";
include_once '../../dbcon.php';

echo "<meta charset='utf-8'>";

mysqli_autocommit($db_conx, FALSE);
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

echo "<h3>Research: <label style='color: red;'>" . $row['rname'] . "</h3>";
?>

<?php
if (!extension_loaded('lapack'))
    die('skip');
?>
<!--FILE-->
<?php

function printEigVal($e) {
    echo ($e < 0 ? '' : ' '), sprintf("%01.2f", $e);
}

function printEig($e) {
    foreach ($e as $row) {
        echo "<br/>";
        foreach ($row as $col) {
            if (count($col) == 1) {
                echo " ", printEigVal($col[0]);
            } else {
                echo "( ", printEigVal($col[0]), ", ", printEigVal($col[1]), ") ";
            }
        }
        echo "\n";
    }
    echo "\n";
}

$sql1 = "SELECT * from research_user where r_id =$research_id order by u_id ASC";
$result1 = mysqli_query($db_conx, $sql1);
while ($row1 = mysqli_fetch_array($result1)) {
    $u_id = $row1['u_id'];
    $sql2 = "SELECT * from quest where r_id =$research_id and type=1 order by quest_id ASC";
    $result2 = mysqli_query($db_conx, $sql2);
    while ($row2 = mysqli_fetch_array($result2)) {
        $a = array();
        $quest_id = $row2['quest_id'];
        if ($row2['sub'] == 2) {
            $select = "SELECT * from sub_criteria where r_id = $research_id order by sub_criteria_id ASC";
            $result_select = mysqli_query($db_conx, $select);
            while ($row_select = mysqli_fetch_array($result_select)) {
                $factor_id = $row_select['sub_criteria_id'];
                $a = array();
                $sql3 = "SELECT * from quest_alternatives where q_id =" . $row2['quest_id'] . " order by t_id1 ASC";
                $result3 = mysqli_query($db_conx, $sql3);
                while ($row3 = mysqli_fetch_array($result3)) {
                    $b = array();
                    $sql4 = "SELECT * from technology_answers where r_id=$research_id and q_id =" . $row2['quest_id'] . " and u_id=" . $row1['u_id'] . " and t1_id=" . $row3['t_id1'] . " and f_id=" . $row_select['sub_criteria_id'] . "  order by t2_id ASC";
                    $result4 = mysqli_query($db_conx, $sql4);
                    while ($row4 = mysqli_fetch_array($result4)) {
                        $sql4 = "SELECT * from technology_answers where r_id=$research_id and q_id =" . $row2['quest_id'] . " and u_id=" . $row1['u_id'] . " and t1_id=" . $row3['t_id1'] . " and f_id=" . $row_select['sub_criteria_id'] . " and t2_id=" . $row4['c_id2'];
                        $n = $row4['value'];
                        echo "$n - ";
                        $n = ($n == (int) $n) ? (int) $n : (float) $n;
                        array_push($b, $n);
                    }

                    array_push($a, $b);
                    unset($b);
                    echo "<br/>";
                }
                echo "<h2>MY ANSWERS " . $row2['qname'] . " </h2>";
                echo "<h3>" . $row_select['sub_cr_name'] . "</h3>";

                echo "<h4>EIGENVALUES </h4>";
                $result = Lapack::eigenValues($a);
                echo '<pre>'; print_r($result); echo '</pre>';
                $counter = 0;

                // round the result so we have a chance of matching in the face of float variance
                foreach ($result as $k => $r) {
                    foreach ($r as $ik => $ir) {
                        $result[$k][$ik] = round($ir, 3);
                    }
                    $counter++;
                }
                var_dump($result);

                echo "<h4>MAX EIGENVALUE  $counter</h4>";

                for ($i = 0; $i < $counter; $i++) {
                    if ($result[$i][1] == NULL) {
                        $lmax = $result[$i][0];
                    }
                }

                for ($i = 0; $i < $counter; $i++) {
                    if ($result[$i][1] == NULL) {
                        if ($lmax < $result[$i][0]) {
                            $lmax = $result[$i][0];
                            $j = $i;
                        }
                    }
                }

                echo $lmax . " - Thesi:" . $j;


                $rightEig = array();
                $result = Lapack::eigenValues($a, null, $rightEig);
                echo "<h4>Right eigenvectors</h4>";

                $sum = 0;
                $vectors = '';
                for ($i = 0; $i < $counter; $i++) {
                    $rightEig[$i][$j][$j] = round($rightEig[$i][$j][$j], 3);
                    echo abs($rightEig[$i][$j][$j]) . '<br/>';
                    $vectors .= "|" . abs($rightEig[$i][$j][$j]);
                    $sum = $sum + abs($rightEig[$i][$j][$j]);
                }
                echo $vectors;

                $weights = '';
                echo "<h4>WEIGHTS (stroggilopoiimena)</h4>";
                echo "Sum = " . $sum;
                for ($i = 0; $i < $counter; $i++) {
                    $w = abs($rightEig[$i][$j][$j]) / $sum;
                    $w = round($w, 3);
                    $weights .= "|" . $w;
                    echo "<br/>W$i = $w";
                }

                echo "<br/>$weights";

                $CI = ($lmax - $counter) / ($counter - 1);
                $CI = round($CI, 3);
                echo "<br/><br/>CI=$CI";

                if ($counter == 1 || $counter == 2) {
                    $RI = 0;
                } else if ($counter == 3) {
                    $RI = 0.52;
                } else if ($counter == 4) {
                    $RI = 0.89;
                } else if ($counter == 5) {
                    $RI = 1.11;
                } else if ($counter == 6) {
                    $RI = 1.25;
                } else if ($counter == 7) {
                    $RI = 1.35;
                } else if ($counter == 8) {
                    $RI = 1.4;
                } else if ($counter == 9) {
                    $RI = 1.45;
                } else if ($counter == 10) {
                    $RI = 1.49;
                }

                echo "<br/>RI=$RI";

                $CR = $CI / $RI;
                $CR = round($CR, 3);
                echo "<br/>CR=$CR<br/> <br/> <br/> <br/>";

                unset($a);

                $insert = "INSERT INTO weights_technology VALUES ($quest_id,$research_id,$u_id,$factor_id,'$weights');";
                $result = mysqli_query($db_conx, $insert) or trigger_error("Query Failed! SQL: $insert - Error: ".mysqli_error($db_conx), E_USER_ERROR);
                $insert = "INSERT INTO eigenvalues_technology VALUES ($quest_id,$research_id,$u_id,$factor_id,$lmax,'$vectors',$CI,$RI,$CR);";
                $result = mysqli_query($db_conx, $insert) or trigger_error("Query Failed! SQL: $insert - Error: ".mysqli_error($db_conx), E_USER_ERROR);
            }
        } else {
            $sql3 = "SELECT * from quest_criteria where q_id =" . $row2['quest_id'] . " order by c_id ASC";
            $result3 = mysqli_query($db_conx, $sql3);
            while ($row3 = mysqli_fetch_array($result3)) {
                $c_id = $row3['c_id'];
                $b = array();
                $sql4 = "SELECT * from answers where r_id=$research_id and q_id =" . $row2['quest_id'] . " and u_id=" . $row1['u_id'] . " and c_id1=" . $row3['c_id'] . " order by c_id2 ASC";
                $result4 = mysqli_query($db_conx, $sql4);
                while ($row4 = mysqli_fetch_array($result4)) {
                    $sql4 = "SELECT * from answers where r_id=$research_id and q_id =" . $row2['quest_id'] . " and u_id=" . $row1['u_id'] . " and c_id1=" . $row3['c_id'] . " and c_id2=" . $row4['c_id2'];
                    $n = $row4['value'];
                    echo "$n - ";
                    $n = ($n == (int) $n) ? (int) $n : (float) $n;
                    array_push($b, $n);
                }
                array_push($a, $b);
                unset($b);

                echo "<br/>";
            }
            echo "<h2>MY ANSWERS " . $row2['qname'] . " </h2>";

            echo "<h4>EIGENVALUES </h4>";
            $result = Lapack::eigenValues($a);
            echo '<pre>'; print_r($result); echo '</pre>';
            $counter = 0;

            // round the result so we have a chance of matching in the face of float variance
            foreach ($result as $k => $r) {
                foreach ($r as $ik => $ir) {
                    $result[$k][$ik] = round($ir, 3);
                }
                $counter++;
            }
            var_dump($result);

            echo "<h4>MAX EIGENVALUE  $counter</h4>";

            for ($i = 0; $i < $counter; $i++) {
                if ($result[$i][1] == NULL) {
                    $lmax = $result[$i][0];
                }
            }

            for ($i = 0; $i < $counter; $i++) {
                if ($result[$i][1] == NULL) {
                    if ($lmax < $result[$i][0]) {
                        $lmax = $result[$i][0];
                        $j = $i;
                    }
                }
            }

            echo $lmax . " - Thesi:" . $j;

            $rightEig = array();
            $result = Lapack::eigenValues($a, null, $rightEig);
            echo "<h4>Right eigenvectors</h4>";

            $sum = 0;
            $vectors = '';
            for ($i = 0; $i < $counter; $i++) {
                $rightEig[$i][$j][$j] = round($rightEig[$i][$j][$j], 3);
                echo abs($rightEig[$i][$j][$j]) . '<br/>';
                $vectors .= "|" . abs($rightEig[$i][$j][$j]);
                $sum = $sum + abs($rightEig[$i][$j][$j]);
            }
            echo $vectors;

            $weights = '';
            echo "<h4>WEIGHTS (rounded)</h4>";
            echo "Sum = " . $sum;
            for ($i = 0; $i < $counter; $i++) {
                $w = abs($rightEig[$i][$j][$j]) / $sum;
                $w = round($w, 3);
                $weights .= "|" . $w;
                echo "<br/>W$i = $w";
            }

            echo "<br/>$weights";

            $CI = ($lmax - $counter) / ($counter - 1);
            $CI = round($CI, 3);
            echo "<br/><br/>CI=$CI";

            if ($counter == 1 || $counter == 2) {
                $RI = 0;
            } else if ($counter == 3) {
                $RI = 0.52;
            } else if ($counter == 4) {
                $RI = 0.89;
            } else if ($counter == 5) {
                $RI = 1.11;
            } else if ($counter == 6) {
                $RI = 1.25;
            } else if ($counter == 7) {
                $RI = 1.35;
            } else if ($counter == 8) {
                $RI = 1.4;
            } else if ($counter == 9) {
                $RI = 1.45;
            } else if ($counter == 10) {
                $RI = 1.49;
            }

            echo "<br/>RI=$RI";

            $CR = $CI / $RI;
            $CR = round($CR, 3);
            echo "<br/>CR=$CR<br/> <br/> <br/> <br/>";

            unset($a);

            $insert = "INSERT INTO weights VALUES ($quest_id,$research_id,$u_id,$c_id,'$weights');";
            $result = mysqli_query($db_conx, $insert) or trigger_error("Query Failed! SQL: $insert - Error: ".mysqli_error($db_conx), E_USER_ERROR);

            $insqert = "INSERT INTO eigenvalues VALUES ($quest_id,$research_id,$u_id,$lmax,'$vectors',$CI,$RI,$CR);";
            $result = mysqli_query($db_conx, $insqert) or trigger_error("Query Failed! SQL: $insqert - Error: ".mysqli_error($db_conx), E_USER_ERROR);

        }
    }
}
?>

<!--FOOTER-->
<?php
mysqli_commit($db_conx);
mysqli_close($db_conx);

header('Location: ranking.php');

include_once "footer.php";
?>