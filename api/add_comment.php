<?php
    session_start();
    require_once("db.php");

    if ($_GET['id'] && $_GET['data'] && $_GET['author']) {
        $id = $_GET['id'];
        $data = $_GET['data'];
        $author = $_GET['author'];
        $name = $db->query("SELECT * FROM `post` WHERE id = '$id'")->fetch_assoc()['author'];
        $res = $db->query("SELECT * FROM `user` WHERE username='$name'")->fetch_assoc();
        $notif = $res['notif'];
        $email = $res['email'];
        if ($notif) {
            $user_id = $_SESSION['id'];
            mail($email, "New comment", "Hello, ".$name.". You have new comment.<br><a href='http://localhost/post.php?id=".$id."'Check post</a>", "From: admin@localhost.ru");
            $stmt = $db->prepare("INSERT INTO `notif` (`user_id`, `data`, `author`, `post_id`) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $user_id, $data, $author, $id);
            $stmt->execute();
        }
        $db->query("INSERT INTO `comments` (`post_id`, `data`, `author`) VALUES ('$id', '$data', '$author')");
        $db->query("UPDATE `post` SET comments = comments + 1 WHERE id = '$id'");
    }
?>
