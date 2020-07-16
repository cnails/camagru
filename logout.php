<?php
    session_start();

    $_SESSION['name'] = "";
    $_SESSION['likes'] = array();
    header("Location: index.php");
?>
