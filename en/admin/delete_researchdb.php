<?php

include_once "../../dbcon.php";
session_start();
mysqli_autocommit($db_conx, FALSE);

if (!empty($_POST['mode'])) {
    foreach ($_POST['mode'] as $research) {

        $sql = "DELETE FROM technology_answers WHERE r_id = $research";
        if (!mysqli_query($db_conx, $sql)) {
            mysqli_rollback($db_conx);
            $_SESSION['error'] = 'all ok';
            echo "<meta charset='utf-8'>";
            $message = "Delete failed. Error: 1";
            echo "<script type='text/javascript'>alert('$message'); window.location = 'delete_research.php';</script>";
            die('Error: ' . mysqli_error($db_conx));
        }

        $sql = "DELETE FROM answers WHERE r_id = $research";
        if (!mysqli_query($db_conx, $sql)) {
            mysqli_rollback($db_conx);
            $_SESSION['error'] = 'all ok';
            echo "<meta charset='utf-8'>";
            $message = "Delete failed. Error: 2";
            echo "<script type='text/javascript'>alert('$message'); window.location = 'delete_research.php';</script>";
            die('Error: ' . mysqli_error($db_conx));
        }


        $sql = "DELETE FROM research_user WHERE r_id = $research";
        if (!mysqli_query($db_conx, $sql)) {
            mysqli_rollback($db_conx);
            $_SESSION['error'] = 'all ok';
            echo "<meta charset='utf-8'>";
            $message = "Delete failed. Error: 3";
            echo "<script type='text/javascript'>alert('$message'); window.location = 'delete_research.php';</script>";
            die('Error: ' . mysqli_error($db_conx));
        }


        $sql = "DELETE FROM quest WHERE r_id = $research";
        if (!mysqli_query($db_conx, $sql)) {
            mysqli_rollback($db_conx);
            $_SESSION['error'] = 'all ok';
            echo "<meta charset='utf-8'>";
            $message = "Delete failed. Error: 4";
            echo "<script type='text/javascript'>alert('$message'); window.location = 'delete_research.php';</script>";
            die('Error: ' . mysqli_error($db_conx));
        }
        
        $sql = "DELETE FROM quest_criteria WHERE r_id = $research";
        if (!mysqli_query($db_conx, $sql)) {
            mysqli_rollback($db_conx);
            $_SESSION['error'] = 'all ok';
            echo "<meta charset='utf-8'>";
            $message = "Delete failed. Error: 7";
            echo "<script type='text/javascript'>alert('$message'); window.location = 'delete_research.php';</script>";
            die('Error: ' . mysqli_error($db_conx));
        }

        $sql = "DELETE FROM criteria WHERE r_id = $research";
        if (!mysqli_query($db_conx, $sql)) {
            mysqli_rollback($db_conx);
            $_SESSION['error'] = 'all ok';
            echo "<meta charset='utf-8'>";
            $message = "Delete failed. Error: 8";
            echo "<script type='text/javascript'>alert('$message'); window.location = 'delete_research.php';</script>";
            die('Error: ' . mysqli_error($db_conx));
        }

        $sql = "DELETE FROM sub_criteria WHERE r_id = $research";
        if (!mysqli_query($db_conx, $sql)) {
            mysqli_rollback($db_conx);
            $_SESSION['error'] = 'all ok';
            echo "<meta charset='utf-8'>";
            $message = "Delete failed. Error: 9";
            echo "<script type='text/javascript'>alert('$message'); window.location = 'delete_research.php';</script>";
            die('Error: ' . mysqli_error($db_conx));
        }
        
        $sql = "DELETE FROM technology where r_id = $research";
        if (!mysqli_query($db_conx, $sql)) {
            mysqli_rollback($db_conx);
            $_SESSION['error'] = 'all ok';
            echo "<meta charset='utf-8'>";
            $message = "Delete failed. Error: 10";
            echo "<script type='text/javascript'>alert('$message'); window.location = 'delete_research.php';</script>";
            die('Error: ' . mysqli_error($db_conx));
        }
        
        $sql = "DELETE FROM quest_alternatives where r_id = $research";
        if (!mysqli_query($db_conx, $sql)) {
            mysqli_rollback($db_conx);
            $_SESSION['error'] = 'all ok';
            echo "<meta charset='utf-8'>";
            $message = "Delete failed. Error: 11";
            echo "<script type='text/javascript'>alert('$message'); window.location = 'delete_research.php';</script>";
            die('Error: ' . mysqli_error($db_conx));
        }
        
        $sql = "DELETE FROM eigenvalues where r_id=$research";
        if (!mysqli_query($db_conx, $sql)) {
            mysqli_rollback($db_conx);
            $_SESSION['error'] = 'all ok';
            echo "<meta charset='utf-8'>";
            $message = "Delete failed. Error: 12";
            echo "<script type='text/javascript'>alert('$message'); window.location = 'delete_research.php';</script>";
            die('Error: ' . mysqli_error($db_conx));
        }
        
        $sql = "DELETE FROM eigenvalues_technology where r_id=$research";
        if (!mysqli_query($db_conx, $sql)) {
            mysqli_rollback($db_conx);
            $_SESSION['error'] = 'all ok';
            echo "<meta charset='utf-8'>";
            $message = "Delete failed. Error: 13";
            echo "<script type='text/javascript'>alert('$message'); window.location = 'delete_research.php';</script>";
            die('Error: ' . mysqli_error($db_conx));
        }
        
        $sql = "DELETE FROM avg_weight where r_id=$research";
        if (!mysqli_query($db_conx, $sql)) {
            mysqli_rollback($db_conx);
            $_SESSION['error'] = 'all ok';
            echo "<meta charset='utf-8'>";
            $message = "Delete failed. Error: 14";
            echo "<script type='text/javascript'>alert('$message'); window.location = 'delete_research.php';</script>";
            die('Error: ' . mysqli_error($db_conx));
        }
        
        
        $sql = "DELETE FROM avg_weight_technology where r_id=$research";
        if (!mysqli_query($db_conx, $sql)) {
            mysqli_rollback($db_conx);
            $_SESSION['error'] = 'all ok';
            echo "<meta charset='utf-8'>";
            $message = "Delete failed. Error: 15";
            echo "<script type='text/javascript'>alert('$message'); window.location = 'delete_research.php';</script>";
            die('Error: ' . mysqli_error($db_conx));
        }
        
        
        $sql = "DELETE FROM ranking where r_id=$research";
        if (!mysqli_query($db_conx, $sql)) {
            mysqli_rollback($db_conx);
            $_SESSION['error'] = 'all ok';
            echo "<meta charset='utf-8'>";
            $message = "Delete failed. Error: 16";
            echo "<script type='text/javascript'>alert('$message'); window.location = 'delete_research.php';</script>";
            die('Error: ' . mysqli_error($db_conx));
        }
        
        
        $sql = "DELETE FROM ranking_final where r_id=$research";
        if (!mysqli_query($db_conx, $sql)) {
            mysqli_rollback($db_conx);
            $_SESSION['error'] = 'all ok';
            echo "<meta charset='utf-8'>";
            $message = "Delete failed. Error: 17";
            echo "<script type='text/javascript'>alert('$message'); window.location = 'delete_research.php';</script>";
            die('Error: ' . mysqli_error($db_conx));
        }
        
        
        $sql = "DELETE FROM weights where r_id=$research";
        if (!mysqli_query($db_conx, $sql)) {
            mysqli_rollback($db_conx);
            $_SESSION['error'] = 'all ok';
            echo "<meta charset='utf-8'>";
            $message = "Delete failed. Error: 18";
            echo "<script type='text/javascript'>alert('$message'); window.location = 'delete_research.php';</script>";
            die('Error: ' . mysqli_error($db_conx));
        }
        
        
        $sql = "DELETE FROM weights_technology where r_id=$research";
        if (!mysqli_query($db_conx, $sql)) {
            mysqli_rollback($db_conx);
            $_SESSION['error'] = 'all ok';
            echo "<meta charset='utf-8'>";
            $message = "Delete failed. Error: 19";
            echo "<script type='text/javascript'>alert('$message'); window.location = 'delete_research.php';</script>";
            die('Error: ' . mysqli_error($db_conx));
        }

        $sql = "DELETE FROM research WHERE research_id = $research";
        if (!mysqli_query($db_conx, $sql)) {
            mysqli_rollback($db_conx);
            $_SESSION['error'] = 'all ok';
            echo "<meta charset='utf-8'>";
            $message = "Delete failed. Error: 20";
            echo "<script type='text/javascript'>alert('$message'); window.location = 'delete_research.php';</script>";
            die('Error: ' . mysqli_error($db_conx));
        }
    
    }
} else {
    echo "<meta charset='utf-8'>";
    $message = "Delete failed. No research was selected!";
    echo "<script>alert('$message');</script>";
    echo "<script>history.go(-1);</script>";
    return false;
    echo "<script>e.preventDefault();</script>";
    die('Error: ' . mysqli_error($db_conx));
}


$_SESSION['error'] = 'all ok';
mysqli_commit($db_conx);
mysqli_close($db_conx);
echo "<meta charset='utf-8'>";
$message = "Researches deleted!!";
echo "<script type='text/javascript'>alert('$message'); window.location = 'delete_research.php';</script>";
?>