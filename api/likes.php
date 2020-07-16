<?php
    session_start();
    require_once("db.php");

    if ($_GET['action'] && $_GET['post_id']) {
        $id = $_GET['post_id'];
        if ($_GET['action'] == "delete") {
            $query = "UPDATE `post` SET likes = likes - 1 WHERE id = '$id'";
            unset($_SESSION['likes'][$id]);
            $db->query($query);
        } else {
            $query = "UPDATE `post` SET likes = likes + 1 WHERE id = '$id'";
            $_SESSION['likes'][$id] = $id;
            $db->query($query);
        }
    }
?>
