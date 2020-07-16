<?php
    session_start();

    require_once("db.php");

    if ($_GET['old_pwd'] && $_GET['new_pwd']) {
        $name = $_SESSION['name'];
        $old_pwd = hash('whirlpool', $_GET['old_pwd']);
        $new_pwd = hash('whirlpool', $_GET['new_pwd']);
        $res = $db->query("SELECT * FROM `user` WHERE username = '$name' and pwd = '$old_pwd' LIMIT 1")->fetch_assoc();
        if (count($res) == 0) {
            echo json_encode(false);
            return;
        }
        $db->query("UPDATE `user` SET pwd='$new_pwd' WHERE username='$name'");
        echo json_encode(true);
    }
?>
