<?php
    session_start();

    require_once("db.php");
    if ($_GET['token']) {
        $token = $_GET['token'];
        $res = $db->query("SELECT * FROM `user` WHERE token='$token'")->fetch_assoc();
        if (count($res) == 0) {
            echo "<h1>wrong token :(</h1>";
            return;
        }
        $db->query("UPDATE `user` SET confirm=1 WHERE token='$token'");
        $_SESSION['name'] = $res['username'];
        $_SESSION['id'] = $res['id'];
        $_SESSION['likes'] = array();
        header("Location: ../index.php");
    }
?>
