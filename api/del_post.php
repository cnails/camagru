<?php
    session_start();

    require_once("db.php");

    if ($_GET['id']) {
        $id = $_GET['id'];
        $db->query("DELETE FROM `post` WHERE `post`.`id` = '$id'");
    }
?>
