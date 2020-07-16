<?php
    session_start();

    require_once("db.php");

    if ($_GET['token']) {
        $token = $_GET['token'];
        $res = $db->query("SELECT * FROM `user` WHERE token = '$token'")->fetch_assoc();
        if (count($res) > 0) {
            $name = $res['username'];
            $db->query("UPDATE `user` SET email = 1 WHERE username = '$name'");
        }
    }
?>
