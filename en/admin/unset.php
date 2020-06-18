<?php
session_start();
unset($_SESSION['research_id']);
unset($_SESSION['quest_id']);

echo "<script>window.location='main.php';</script>";

?>


