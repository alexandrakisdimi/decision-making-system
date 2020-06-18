<?php

include_once "../../dbcon.php";
session_start();
echo "<meta charset='utf-8'>";
mysqli_autocommit($db_conx, FALSE);
$quest_id = $_SESSION['quest_id'];
$research_id = $_SESSION['research_id'];
$quest_type = $_SESSION['quest_type'];
$counter = $_SESSION['counter'];

$description = $_POST['description'];
if ($_POST['description'] == '') {
    mysqli_commit($db_conx);
    mysqli_close($db_conx);
    $message = "H περιγραφή του κριτηρίου #$count είναι κενή";
    echo "<script>alert('$message');</script>";
    echo "<script>history.go(-1);</script>";
    return false;
    echo "<script>e.preventDefault();</script>";
}

$count = 1;
while ($count <= $counter) {
    if (isset($_POST['checkboxes_' . $count])) {
        if (($_POST['unit_' . $count] == '')) {
            mysqli_commit($db_conx);
            mysqli_close($db_conx);
            $message = "Η μονάδα μέτρησης $count είναι κενή";
            echo "<script>alert('$message');</script>";
            echo "<script>history.go(-1);</script>";
            return false;
            echo "<script>e.preventDefault();</script>";
        }
    }

    if (isset($_POST['checkbox_' . $count])) {
        if (($_POST['from_' . $count] == '') || ($_POST['to_' . $count] == '')) {
            mysqli_commit($db_conx);
            mysqli_close($db_conx);
            $message = "Το πεδίο ορισμού $count είναι κενό";
            echo "<script>alert('$message');</script>";
            echo "<script>history.go(-1);</script>";
            return false;
            echo "<script>e.preventDefault();</script>";
        }
    }
    $count++;
}

$count = 1;
while (isset($_POST['textbox' . $count])) {

    if ($_POST['textbox' . $count] == '') {
        mysqli_commit($db_conx);
        mysqli_close($db_conx);
        $message = "Το όνομα της χρονολογίας #$count είναι κενό";
        echo "<script>alert('$message');</script>";
        echo "<script>history.go(-1);</script>";
        return false;
        echo "<script>e.preventDefault();</script>";
    }
    $count++;
}



//eisagwgi stin vasi
$count = 1;
while (isset($_POST['textbox' . $count])) {

    $sql = "INSERT into years Values ($quest_id," . $_POST['textbox' . $count] . ")";
    if (!mysqli_query($db_conx, $sql)) {
        mysqli_rollback($db_conx);
        $_SESSION['error'] = 'all ok';
        echo "<meta charset='utf-8'>";
        $message = "Η εισαγωγή χρονολογίας απέτυχε";
        echo "<script type='text/javascript'>alert('$message'); history.go(-1);</script>";
        die('Error: ' . mysqli_error($db_conx));
    }
    $count++;
}


$count = 1;
while ($count <= $counter) {
    if (isset($_POST['checkboxes_' . $count])) {
        $sql = "Update quest2 set unit='" . $_POST['unit_' . $count] . "' where c_id=" .$_POST['checkboxes_' . $count] . " and q_id=$quest_id";
        if (!mysqli_query($db_conx, $sql)) {
            mysqli_rollback($db_conx);
            $_SESSION['error'] = 'all ok';
            echo "<meta charset='utf-8'>";
            $message = "Η ενημέρωση του πεδίου ορισμού απέτυχε";
            echo "<script type='text/javascript'>alert('$message'); history.go(-1);</script>";
            die('Error: ' . mysqli_error($db_conx));
        }
    }

    if (isset($_POST['checkbox_' . $count])) {
        $sql = "Update quest2 set c_range='" . $_POST['from_' . $count] . "-" . $_POST['to_' . $count] . "' where c_id=" . $_POST['checkboxes_' . $count]. " and q_id=$quest_id";
        if (!mysqli_query($db_conx, $sql)) {
            mysqli_rollback($db_conx);
            $_SESSION['error'] = 'all ok';
            echo "<meta charset='utf-8'>";
            $message = "Η ενημέρωση της μονάδας μέτρησης απέτυχε";
            echo "<script type='text/javascript'>alert('$message'); history.go(-1);</script>";
            die('Error: ' . mysqli_error($db_conx));
        }
    }
    
    $sql = "Update quest2 set description='$description'";
    if (!mysqli_query($db_conx, $sql)) {
            mysqli_rollback($db_conx);
            $_SESSION['error'] = 'all ok';
            echo "<meta charset='utf-8'>";
            $message = "Η ενημέρωση της περιγραφής απέτυχε";
            echo "<script type='text/javascript'>alert('$message'); history.go(-1);</script>";
            die('Error: ' . mysqli_error($db_conx));
        }
    $count++;
}

mysqli_commit($db_conx);
mysqli_close($db_conx);
echo "<meta charset='utf-8'>";
$message = "Το ερωτηματολόγιο δημιουργήθηκε επιτυχώς";
echo "<script type='text/javascript'>alert('$message'); window.location = 'create_quest.php';</script>";

?>