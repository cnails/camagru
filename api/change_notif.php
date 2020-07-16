<?php
    session_start();

    require_once("db.php");

    if ($_GET['action']) {
        $name = $_SESSION['name'];
        if ($_GET['action'] == "del") {
            $db->query("UPDATE `user` SET notif = 0 WHERE username='$name'");
        } else {
            $db->query("UPDATE `user` SET notif = 1 WHERE username='$name'");
        }
        echo json_encode($_GET['action']);
    }
?>
